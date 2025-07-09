@extends('layouts.admin')

@section('breadcump-content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Manajemen Berita</h4>
            <div class="pt-2">
                <a class="btn btn-primary" href="{{ route('dashboard.berita.create') }}" role="button">
                    Tambah Berita Baru +
                </a>
            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Berita</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('admin-content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Berita</h4>

                <div class="table-responsive">
                    <table id="beritaTable" class="table table-striped table-bordered display responsive"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($beritas as $berita)
                            <tr>
                                <td>{{ $berita->id }}</td>
                                <td>{{ $berita->judul }}</td>
                                <td>{{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}</td>
                                <td>
                                    @if ($berita->gambar)
                                    <img src="{{ asset('uploads/berita/' . $berita->gambar) }}" alt="Gambar"
                                        width="100">
                                    @else
                                    <span class="text-muted">Tidak Ada</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('dashboard.berita.edit', $berita->id) }}"
                                            class="btn btn-sm btn-primary text-white">Edit</a>
                                        <form action="{{ route('dashboard.berita.destroy', $berita->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus berita ini?')"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger text-white"
                                                style="margin-left: 5px;">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $beritas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection