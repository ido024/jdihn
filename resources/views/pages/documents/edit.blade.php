@extends('layouts.admin')
<style>
    .cke_notifications_area {
        display: none !important;
    }

</style>
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
            <form action="{{route('dashboard.documents.update', $dokumen->id)}}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('put')
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
                                    <select name="jenis_dokuemn_id" class="form-control">
                                        <option value="">Pilih Jenis Dokumen</option>
                                        @foreach ($jenisDocuments as $jenisDocument)
                                        <option value="{{ $jenisDocument->id }}"
                                            {{ old('jenis_dokuemn_id', $dokumen->jenis_dokuemn_id ?? '') == $jenisDocument->id ? 'selected' : '' }}>
                                            {{ $jenisDocument->nama }}
                                        </option>
                                        @endforeach
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
                                        value="{{$dokumen->tgl_penetapan}}">
                                </div>
                            </div>
                        </div>

                        {{-- Judul --}}
                        <div class="col-md-6 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-heading"></i> Judul
                                </label>
                                <input type="text" class="form-control" name="judul" value="{{$dokumen->judul}}"
                                    placeholder="Masukkan Judul Dokumen">
                            </div>
                        </div>

                        {{-- Nomor --}}
                        <div class="col-md-3 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-hashtag"></i> Nomor
                                </label>
                                <input type="text" class="form-control" name="nomor" value="{{$dokumen->nomor}}"
                                    placeholder="Masukkan Nomor Dokumen">
                            </div>
                        </div>

                        {{-- Tahun --}}
                        <div class="col-md-3 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-calendar"></i> Tahun
                                </label>
                                <input type="number" class="form-control" name="tahun" value="{{$dokumen->tahun}}"
                                    placeholder="Masukkan Tahun Dokumen">
                            </div>
                        </div>

                        {{-- Subyek --}}
                        <div class="col-md-6 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-user"></i> Subyek
                                </label>
                                <input type="text" class="form-control" name="subyek" value="{{$dokumen->subyek}}"
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
                                    <option value="berlaku" {{ $dokumen->status == 'berlaku' ? 'selected' : '' }}>
                                        Berlaku</option>
                                    <option value="tidak berlaku"
                                        {{ $dokumen->status == 'tidak berlaku' ? 'selected' : '' }}>
                                        Tidak Berlaku</option>
                                    <option value="diperiksa" {{ $dokumen->status == 'diperiksa' ? 'selected' : '' }}>
                                        Diperiksa</option>
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
                                    value="{{$dokumen->penandatanganan }}" placeholder="Masukkan Nama Penandatangan">
                            </div>
                        </div>

                        {{-- Singkatan Jenis --}}
                        <div class="col-md-6 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-font"></i> Singkatan Jenis
                                </label>
                                <input type="text" class="form-control" name="singkatan_jenis"
                                    value="{{$dokumen->singkatan_jenis }}" placeholder="Masukkan Singkatan Jenis">
                            </div>
                        </div>

                        {{-- Tempat Terbit --}}
                        <div class="col-md-6 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-map-marker-alt"></i> Tempat Terbit
                                </label>
                                <input type="text" class="form-control" name="tempat_terbit"
                                    value="{{$dokumen->tempat_terbit }}" placeholder="Masukkan Tempat Terbit">
                            </div>
                        </div>

                        {{-- Asal Dokumen --}}
                        <div class="col-md-6 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-archive"></i> Asal Dokumen
                                </label>
                                <input type="text" class="form-control" name="asal_dokumen"
                                    value="{{$dokumen->asal_dokumen }}" placeholder="Masukkan Asal Dokumen">
                            </div>
                        </div>

                        {{-- Sumber --}}
                        <div class="col-md-6 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-bookmark"></i> Sumber
                                </label>
                                <input type="text" class="form-control" name="sumber" value="{{$dokumen->sumber }}"
                                    placeholder="Masukkan Sumber Dokumen">
                            </div>
                        </div>

                        {{-- Bahasa --}}
                        <div class="col-md-6 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-language"></i> Bahasa
                                </label>
                                <input type="text" class="form-control" name="bahasa" value="{{$dokumen->bahasa }}"
                                    placeholder="Masukkan Bahasa Dokumen">
                            </div>
                        </div>

                        {{-- TEU --}}
                        <div class="col-md-6 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-users"></i> TEU (Nama Badan / Orang)
                                </label>
                                <input type="text" class="form-control" name="teu" value="{{$dokumen->teu }}"
                                    placeholder="Masukkan TEU">
                            </div>
                        </div>

                        {{-- Upload File --}}
                        <div class="card mt-3 col-12 rounded shadow-sm">
                            <div class="card-header bg-light">
                                <strong>Upload File Dokumen & Abstrak</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    {{-- Upload Dokumen --}}
                                    <div class="col-md-6 pt-2">
                                        <div class="form-group">
                                            <label for="document" class="control-label col-form-label">
                                                <i class="mdi mdi-file-outline"></i> Dokumen
                                            </label>
                                            @if(!empty($dokumen->document))
                                            <p class="mb-1">
                                                <strong>File saat ini:</strong>
                                                <a href="{{ asset('storage/' . $dokumen->document) }}"
                                                    target="_blank">Lihat Dokumen</a>
                                            </p>
                                            @endif
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="mdi mdi-upload"></i></span>
                                                </div>
                                                <input type="file" class="form-control rounded" id="document"
                                                    name="document">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Upload Abstrak --}}
                                    <div class="col-md-6 pt-2">
                                        <div class="form-group">
                                            <label for="abstrak" class="control-label col-form-label">
                                                <i class="mdi mdi-file-outline"></i> Abstrak
                                            </label>
                                            @if(!empty($dokumen->abstrak))
                                            <p class="mb-1">
                                                <strong>File saat ini:</strong>
                                                <a href="{{ asset('storage/' . $dokumen->abstrak) }}"
                                                    target="_blank">Lihat Abstrak</a>
                                            </p>
                                            @endif
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="mdi mdi-upload"></i></span>
                                                </div>
                                                <input type="file" class="form-control rounded" id="abstrak"
                                                    name="abstrak">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-users"></i> Kata Kunci
                                </label>
                                <input type="text" class="form-control" name="kata_kunci"
                                    value="{{ old('kata_kunci', $dokumen->kata_kunci ?? '') }}"
                                    placeholder="Masukkan Kata Kunci">
                            </div>
                        </div>

                        <div class="col-md-12 pt-2">
                            <div class="form-group">
                                <label class="control-label col-form-label">
                                    <i class="fas fa-users"></i> Text Document
                                </label>
                                <textarea class="form-control" id="text_document" name="text_document" rows="5"
                                    placeholder="Masukkan Konten Dokumen">{{ old('text_document', $dokumen->text_document ?? '') }}</textarea>
                            </div>
                        </div>

                        <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
                        <script>
                            CKEDITOR.replace('text_document');
                        </script>

                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <div class="action-form">
                        <div class="form-group m-b-0 text-left">
                            <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                            <a href="{{ route('dashboard.documents.index') }}"
                                class="btn btn-dark waves-effect waves-light">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection