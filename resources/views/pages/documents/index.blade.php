@extends('layouts.admin')

@section('breadcump-content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Menu Master Document</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Document</li>
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
                <h4 class="card-title">Data Master Dokumen </h4>

                <div class="table-responsive">
                    <table id="complex_head_col" class="table table-striped table-bordered display responsive"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th rowspan="2">No</th>
                                <th colspan="5" class="text-center">Detail Informasi Dokumen</th>
                                <th colspan="1">Tanggal Upload Dokumen</th>
                                <th rowspan="1" colspan="1">Aksi</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>Jenis Peraturan</th>
                                <th>Nomor Peraturan</th>
                                <th>Tahun Peraturan </th>
                                <th>Subjek Peraturan </th>
                                <th>Status</th>
                                <th>Tanggal Penetapan</th>
                                <td>Aksi</td>
                                <td></td>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documents as $index => $dokumen)
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <td>{{ $dokumen->jenisDokumen->nama ?? '-' }}</td>
                                <td>{{ $dokumen->nomor ?? '-' }}</td>
                                <td>{{ $dokumen->tahun ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-primary text-white">
                                        {{ $dokumen->subyek ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    @php
                                    $status = strtolower($dokumen->status);
                                    $warna = 'secondary'; // default abu

                                    if ($status == 'berlaku') {
                                    $warna = 'success'; // hijau
                                    } elseif ($status == 'tidak berlaku') {
                                    $warna = 'danger'; // merah
                                    } elseif ($status == 'diperiksa' || $status == 'diperiksa') {
                                    $warna = 'warning'; // kuning
                                    }
                                    @endphp

                                    <span class="badge bg-{{ $warna }} text-white">
                                        {{ ucfirst($dokumen->status ?? '-') }}
                                    </span>
                                </td>
                                <td>{{ $dokumen->tgl_penetapan ? $dokumen->created_at->format('d-m-Y') : '-' }}</td>

                                <td>
                                    <div class="btn-group" role="group" style="gap: 5px;">
                                        {{-- Tombol Detail --}}
                                        <a href="{{ route('dashboard.documents.show', $dokumen->id) }}"
                                            class="btn btn-sm btn-info rounded" title="Detail">
                                            <i class="mdi mdi-eye"></i>
                                        </a>

                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('dashboard.documents.edit', $dokumen->id) }}"
                                            class="btn btn-sm btn-warning rounded" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>

                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('dashboard.documents.destroy', $dokumen->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger rounded" type="submit" title="Hapus">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection