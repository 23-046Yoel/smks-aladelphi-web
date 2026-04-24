<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InventoryController extends Controller
{
    // Public: Tampilan Inventaris
    public function index()
    {
        $items = InventoryItem::orderBy('category')->get();
        $categories = InventoryItem::select('category')->distinct()->pluck('category');
        return view('inventaris.index', compact('items', 'categories'));
    }

    // Admin: List Inventaris
    public function adminIndex()
    {
        $items = InventoryItem::orderBy('updated_at', 'desc')->paginate(15);
        return view('admin.inventory.index', compact('items'));
    }

    // Admin: Form Tambah
    public function create()
    {
        return view('admin.inventory.create');
    }

    // Admin: Simpan Data
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'quantity' => 'required|integer',
            'location' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('inventory', 'public');
        }

        InventoryItem::create($data);
        return redirect()->route('admin.inventory.index')->with('success', 'Aset berhasil ditambahkan ke inventaris!');
    }

    // Admin: Form Edit
    public function edit(InventoryItem $inventory)
    {
        return view('admin.inventory.edit', compact('inventory'));
    }

    // Admin: Update Data
    public function update(Request $request, InventoryItem $inventory)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'quantity' => 'required|integer',
            'location' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();
        if ($request->hasFile('photo')) {
            if ($inventory->photo) Storage::disk('public')->delete($inventory->photo);
            $data['photo'] = $request->file('photo')->store('inventory', 'public');
        }

        $inventory->update($data);
        return redirect()->route('admin.inventory.index')->with('success', 'Data aset berhasil diperbarui!');
    }

    // Admin: Hapus Data
    public function destroy(InventoryItem $inventory)
    {
        if ($inventory->photo) Storage::disk('public')->delete($inventory->photo);
        $inventory->delete();
        return redirect()->route('admin.inventory.index')->with('success', 'Aset berhasil dihapus dari inventaris!');
    }
}
