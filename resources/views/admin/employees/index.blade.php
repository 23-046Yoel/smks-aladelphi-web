@extends('layouts.admin')

@section('title', 'Manajemen Kepegawaian')

@section('header_title', 'Manajemen Kepegawaian & HR')
@section('header_subtitle', 'Kelola data tenaga pendidik dan kependidikan')

@section('extra_css')
    .topbar-actions { display: flex; gap: 10px; margin-bottom: 20px; flex-wrap: wrap; }
    .btn { padding: 10px 22px; border-radius: 10px; font-weight: 700; font-size: 0.85rem; cursor: pointer; border: none; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: 0.2s; }
    .btn-primary { background: var(--red); color: white; }
    .btn-secondary { background: white; color: var(--dark); border: 1px solid #eee; }
    
    .card { background: white; border-radius: 16px; box-shadow: 0 2px 15px rgba(0,0,0,0.06); overflow: hidden; }
    .card-header { padding: 20px 25px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; }
    
    .table-responsive { width: 100%; overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; min-width: 800px; }
    th { background: #f8f9fa; padding: 15px 20px; text-align: left; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; color: #666; font-weight: 700; }
    td { padding: 15px 20px; border-bottom: 1px solid #f5f5f5; font-size: 0.85rem; vertical-align: middle; }
    
    .emp-photo-sm { width: 45px; height: 45px; border-radius: 10px; object-fit: cover; background: #eee; }
    .badge { padding: 4px 12px; border-radius: 30px; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; }
    .badge-aktif { background: #e6f7ed; color: #28a745; }
    .badge-nonaktif { background: #fdeaea; color: #e30613; }
    .badge-guru { background: #e8f4ff; color: #007bff; }
    .badge-staff { background: #fff8e6; color: #f39c12; }
    
    .action-btns { display: flex; gap: 8px; }
    .btn-edit { padding: 6px 12px; background: #fff8e6; color: #f39c12; border-radius: 8px; font-weight: 700; font-size: 0.75rem; text-decoration: none; }
    .btn-delete { padding: 6px 12px; background: #fdeaea; color: #e30613; border-radius: 8px; font-weight: 700; font-size: 0.75rem; cursor: pointer; border: none; }
    
    @media (max-width: 768px) {
        .card-header { flex-direction: column; align-items: flex-start; }
    }
@endsection

@section('content')
    <div class="topbar-actions">
        <a href="{{ url('/kepegawaian') }}" target="_blank" class="btn btn-secondary"><i class="fas fa-eye"></i> Lihat Publik</a>
        <a href="{{ route('admin.employees.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Pegawai</a>
    </div>

    @if(session('success'))
    <div style="padding: 15px; background: #e6f7ed; color: #28a745; border-radius: 12px; margin-bottom: 20px; font-weight: 600;">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 style="margin:0; font-size: 1rem;">Daftar Seluruh Pegawai</h3>
            <span style="font-size:0.8rem; color:#888;">Total: {{ $employees->total() }} pegawai</span>
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Jabatan</th>
                        <th>Jenis</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $index => $emp)
                    <tr>
                        <td>{{ $employees->firstItem() + $index }}</td>
                        <td>
                            @if($emp->photo)
                                <img src="{{ Storage::url($emp->photo) }}" class="emp-photo-sm" alt="Foto" loading="lazy">
                            @else
                                <div class="emp-photo-sm" style="display:flex;align-items:center;justify-content:center;"><i class="fas fa-user" style="color:#ccc;"></i></div>
                            @endif
                        </td>
                        <td><strong>{{ $emp->name }}</strong>@if($emp->subject)<br><small style="color:#888;">{{ $emp->subject }}</small>@endif</td>
                        <td style="color:#888;">{{ $emp->nip ?? '-' }}</td>
                        <td>{{ $emp->position }}</td>
                        <td>
                            <span class="badge badge-{{ $emp->employee_type == 'guru' ? 'guru' : 'staff' }}">
                                {{ ucfirst($emp->employee_type) }}
                            </span>
                        </td>
                        <td><span class="badge badge-{{ $emp->status }}">{{ ucfirst($emp->status) }}</span></td>
                        <td>
                            <div class="action-btns">
                                <a href="{{ route('admin.employees.edit', $emp->id) }}" class="btn-edit"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.employees.destroy', $emp->id) }}" method="POST" onsubmit="return confirm('Hapus data {{ $emp->name }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" style="text-align:center; padding:50px; color:#aaa;">Belum ada data pegawai</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="padding: 20px;">
            {{ $employees->links() }}
        </div>
    </div>
@endsection
