@extends('layouts.admin')

@section('breadcump-content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Menu Pembuatan Data Dokumen Baru</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Dokumen</li>
                        <li class="breadcrumb-item active" aria-current="page">Buat Dokumen Baru</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('admin-content')
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <form action="{{route('dashboard.documents.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <h4 class="card-title">Buat Data Arsip</h4>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <span class="badge badge-info"><i class="fas fa-info"></i></span>
                        <strong> Perhatikan Setiap Form Input Yang Telah Disesuaikan dan Terisi Semua.</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                </div>
                <hr>
                <div class="card-body">
                    <div class="row">
                        {{-- Jenis Dokumen --}}
                        <div class="col-md-6 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-file-alt"></i> Pilih Jenis Dokumen
                                </label>
                                <div class="input-group">
                                    <select class="select2 form-control custom-select" name="jenis_dokuemn_id"
                                        style="width: 100%;">
                                        <option value="">Cari Jenis Dokumen</option>
                                        <optgroup label="Jenis Dokumen">
                                            @foreach ($jenisDocuments as $jenisDocument)
                                            <option value="{{ $jenisDocument->id }}">{{ $jenisDocument->nama }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Tanggal Penetapan --}}
                        <div class="col-md-6 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-calendar-alt"></i> Tanggal Penetapan
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="date" class="form-control" name="tgl_penetapan"
                                        placeholder="Pilih Tanggal Penetapan">
                                </div>
                            </div>
                        </div>

                        {{-- Judul --}}
                        <div class="col-md-6 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-heading"></i> Judul
                                </label>
                                <input type="text" class="form-control" name="judul"
                                    placeholder="Masukkan Judul Dokumen">
                            </div>
                        </div>

                        {{-- Nomor --}}
                        <div class="col-md-3 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-hashtag"></i> Nomor
                                </label>
                                <input type="text" class="form-control" name="nomor"
                                    placeholder="Masukkan Nomor Dokumen">
                            </div>
                        </div>

                        {{-- Tahun --}}
                        <div class="col-md-3 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-calendar"></i> Tahun
                                </label>
                                <input type="number" class="form-control" name="tahun"
                                    placeholder="Masukkan Tahun Dokumen">
                            </div>
                        </div>

                        {{-- Subyek --}}
                        <div class="col-md-6 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-user"></i> Subyek
                                </label>
                                <input type="text" class="form-control" name="subyek"
                                    placeholder="Masukkan Subyek Dokumen">
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-info-circle"></i> Status
                                </label>
                                <select class="form-control" name="status">
                                    <option value="berlaku">Berlaku</option>
                                    <option value="tidak berlaku">Tidak Berlaku</option>
                                    <option value="diperiksa">Diperiksa</option>
                                </select>
                            </div>
                        </div>

                        {{-- Penandatanganan --}}
                        <div class="col-md-6 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-pencil-alt"></i> Penandatangan
                                </label>
                                <input type="text" class="form-control" name="penandatanganan"
                                    placeholder="Masukkan Nama Penandatangan">
                            </div>
                        </div>

                        {{-- Singkatan Jenis --}}
                        <div class="col-md-6 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-font"></i> Singkatan Jenis
                                </label>
                                <input type="text" class="form-control" name="singkatan_jenis"
                                    placeholder="Masukkan Singkatan Jenis">
                            </div>
                        </div>

                        {{-- Tempat Terbit --}}
                        <div class="col-md-6 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-map-marker-alt"></i> Tempat Terbit
                                </label>
                                <input type="text" class="form-control" name="tempat_terbit"
                                    placeholder="Masukkan Tempat Terbit">
                            </div>
                        </div>

                        {{-- Asal Dokumen --}}
                        <div class="col-md-6 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-archive"></i> Asal Dokumen
                                </label>
                                <input type="text" class="form-control" name="asal_dokumen"
                                    placeholder="Masukkan Asal Dokumen">
                            </div>
                        </div>

                        {{-- Sumber --}}
                        <div class="col-md-6 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-bookmark"></i> Sumber
                                </label>
                                <input type="text" class="form-control" name="sumber"
                                    placeholder="Masukkan Sumber Dokumen">
                            </div>
                        </div>

                        {{-- Bahasa --}}
                        <div class="col-md-6 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-language"></i> Bahasa
                                </label>
                                <input type="text" class="form-control" name="bahasa"
                                    placeholder="Masukkan Bahasa Dokumen">
                            </div>
                        </div>

                        {{-- TEU --}}
                        <div class="col-md-6 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-users"></i> TEU (Nama Badan / Orang)
                                </label>
                                <input type="text" class="form-control" name="teu" placeholder="Masukkan TEU">
                            </div>
                        </div>

                        {{-- Abstrak --}}


                        {{-- Upload File --}}
                        <div class="card mt-3 col-12 rounded shadow-sm">
                            <div class="card-header bg-light">
                                <strong>Upload File Dokumen & Abstrak</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 pt-2">
                                        <div class="form-group">
                                            <label for="dokumen" class="control-label col-form-label">
                                                <i class="mdi mdi-file-outline"></i> Dokumen
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="mdi mdi-upload"></i></span>
                                                </div>
                                                <input type="file" class="form-control rounded" id="document"
                                                    name="document" placeholder="Upload File Dokumen">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pt-2">
                                        <div class="form-group">
                                            <label for="abstrak" class="control-label col-form-label">
                                                <i class="mdi mdi-file-outline"></i> Abstrak
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="mdi mdi-upload"></i></span>
                                                </div>
                                                <input type="file" class="form-control rounded" id="abstrak"
                                                    name="abstrak" placeholder="Upload Abstrak">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <div class="action-form">
                        <div class="form-group m-b-0 text-left">
                            <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                            <button type="submit" class="btn btn-dark waves-effect waves-light">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection