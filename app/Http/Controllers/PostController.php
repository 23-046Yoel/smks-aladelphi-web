<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Public: Get posts by category for AJAX
    public function getByCategory(Request $request)
    {
        $category = $request->category ?? 'berita';
        $posts = Post::where('category', $category)->orderBy('published_at', 'desc')->get();
        return response()->json($posts);
    }

    // Public: Show single post
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Admin: List all posts
    public function adminIndex()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    // Admin: Show create form
    public function create()
    {
        return view('admin.posts.create');
    }

    // Admin: Store post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
            'published_at' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $data['image'] = $imagePath;
        }

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Konten berhasil ditambahkan!');
    }

    // Admin: Delete post
    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Konten berhasil dihapus!');
    }
}
