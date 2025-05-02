@extends('layouts.admin')

@section('breadcump-content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Menu Master Catatan Perkara</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Catatan Perkara</li>
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
                <h4 class="card-title">Data Master Catatan Perkara </h4>

                <div class="table-responsive">
                    <table id="complex_head_col" class="table table-striped table-bordered display responsive"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th rowspan="2">No Putusan</th>
                                <th rowspan="2">No Pelimpahan</th>
                                <th colspan="4" class="text-center">Detail Informasi</th>
                                <th rowspan="2">Aksi</th>

                            </tr>
                            <tr>

                                <th>Jaksa Pembuat</th>
                                <th>Tanggal Catatan</th>
                                <th>Isi Catatan</th>
                                <th rowspan="1">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cps as $cp)
                            <tr>
                                <td>{{$cp->no_putusan}}</td>
                                <td>{{$cp->perkara->nomor_perkara}}</td>
                                <td>{{$cp->jaksa->nama_jaksa}}</td>
                                <td>{{$cp->tgl_catatan}}</td>
                                <td>{{$cp->isicatatan}}</td>
                                <td>
                                    <div class="download-links">
                                        @for ($i = 1; $i <= 5; $i++) @if (!empty($cp["file_$i"])) <div>
                                            <i class="mdi mdi-cloud-download"></i>
                                            <a href="{{ asset('storage/' . $cp["file_$i"]) }}"
                                                class="hide-menu">Download Dokumen</a>
                                    </div>
                                    <div>
                                        <i class="mdi mdi-file-check"></i>
                                        <span href="#"
                                            class="hide-menu">{{ pathinfo($cp["file_$i"], PATHINFO_EXTENSION) }}</span>
                                    </div>
                                    <div>
                                        <i class="mdi mdi-file-chart"></i>
                                        <span href="#" class="hide-menu">{{ round($cp["size_$i"] / 1024) }} Kb</span>
                                    </div>
                                    @endif
                                    @endfor
                                    <div class="btn-group">
                                        <a href="{{ route('dashboard.catatanperkara.edit', $cp->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('dashboard.catatanperkara.destroy', $cp->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                style="margin-left: 5px; border-top-left-radius: 0; border-bottom-left-radius: 0;">Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <th></th>
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