@extends('layouts.admin')

@section('breadcump-content')
<style>
    .ck-editor__editable_inline {
        min-height: 300px;
    }

</style>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 align-self-center">
            <h4 class="page-title">Tambah Berita Baru</h4>
            <div class="d-flex align-items-center justify-content-between mt-2">
                <a href="{{ route('dashboard.berita.index') }}" class="btn btn-secondary">← Kembali ke Daftar Berita</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('admin-content')
<div class="row">
    <div class="col-md-12">
        <form action="{{ route('dashboard.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">

                    <!-- Judul -->
                    <div class="form-group mb-3">
                        <label for="judul">Judul Berita</label>
                        <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}"
                            required>
                    </div>

                    <!-- Isi -->
                    <div class="form-group mb-3">
                        <label for="isi">Isi Berita</label>
                        <textarea name="isi" id="isi" class="form-control"
                            style="height: 300px !important;">{{ old('isi') }}</textarea>
                    </div>

                    <!-- Tanggal -->
                    <div class="form-group mb-3">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control"
                            value="{{ old('tanggal', date('Y-m-d')) }}" required>
                    </div>

                    <!-- Gambar -->
                    <div class="form-group mb-4">
                        <label for="gambar">Gambar (Opsional)</label>
                        <input type="file" name="gambar" id="gambar" class="form-control-file">
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Simpan Berita
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('isi');
</script>
@endsection