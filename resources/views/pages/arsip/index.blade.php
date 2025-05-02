@extends('layouts.admin')

@section('breadcump-content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Menu Master Arsip</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Arsip</li>
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
                <h4 class="card-title">Data Master Arsip </h4>

                <div class="table-responsive">
                    <table id="complex_head_col" class="table table-striped table-bordered display responsive"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th rowspan="2">No Arsip / No Perkara</th>
                                <th colspan="5" class="text-center">Detail Informasi Arsip</th>
                                <th colspan="1">Tanggal Upload Arsip</th>
                                <th rowspan="1">Aksi</th>
                            </tr>
                            <tr>
                                <th>File 1</th>
                                <th>File 2</th>
                                <th>File 3</th>
                                <th>File 4</th>
                                <th>File 5</th>
                                <th>Tanggal Upload</th>
                                <td>Aksi</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($arsips as $index => $arsip)
                            <tr>
                                <td>{{$arsip->perkara->nomor_perkara}}</td>
                                <!-- Ganti dengan atribut yang sesuai untuk nomor perkara -->
                                @for ($i = 1; $i <= 5; $i++) <td>
                                    @if (!empty($arsip["file_$i"]))
                                    <div class="download-links">
                                        <div>
                                            <i class="mdi mdi-cloud-download"></i>
                                            <a href="{{ asset('storage/' . $arsip["file_$i"]) }}"
                                                class="hide-menu">Download Arsip</a>
                                        </div>
                                        <div>
                                            <i class="mdi mdi-file-check"></i>
                                            <span href="#"
                                                class="hide-menu">{{ pathinfo($arsip["file_$i"], PATHINFO_EXTENSION) }}</span>
                                        </div>
                                        <div>
                                            <i class="mdi mdi-file-chart"></i>
                                            <span href="#" class="hide-menu">{{ round($arsip["size_$i"] / 1024) }}
                                                Kb</span>
                                        </div>
                                    </div>
                                    @endif
                                    </td>
                                    @endfor
                                    <td>{{ $arsip->tgl_arsip }}</td> <!-- Sesuaikan dengan atribut tanggal arsip -->
                                    <td>
                                        <div class="btn-group">
                                            <form action="{{route('dashboard.arsip.destroy' ,$arsip->id)}}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-danger" type="submit"
                                                    style="margin-left: 5px; border-top-left-radius: 0; border-bottom-left-radius: 0;">Hapus</button>
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