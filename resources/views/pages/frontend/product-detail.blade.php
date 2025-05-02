@extends('layouts.frontend')
@section('frontend-page')
<div class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="top-text header-text">
                    <h6>BIRO HUKUM SETDA PROVINSI JAMBI</h6>
                    <h2>Jaringan Dokumentasi dan Informasi Hukum</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="d-flex flex-column flex-md-row border rounded overflow-hidden shadow-sm bg-light">
                <div class="flex-shrink-0" style="width: 450px; overflow: hidden;">
                    <div class="text-center mb-3">
                        {{-- Preview Dokumen PDF --}}
                        <div class="mx-auto" style="width: 450px; height: 650px; overflow: hidden;">
                            <iframe src="{{ asset('storage/' . $dokumen->document) }}#page=1&zoom=45"
                                style="width: 100%; height: 100%; border: none;" title="Preview Dokumen PDF"
                                loading="lazy">
                            </iframe>
                        </div>

                        {{-- Tombol Download --}}
                        <a href="{{ asset('storage/' . $dokumen->document) }}" target="_blank"
                            class="btn btn-primary mt-3 w-100" download>
                            Download &nbsp;<i class="fa fa-download"></i>
                        </a>
                    </div>
                </div>
                <div class="p-4 d-flex flex-column justify-content-center w-100">
                    <div class="mb-2">
                        <span class="badge bg-primary">{{ $dokumen->jenisDokumen->nama ?? 'Tidak ada jenis' }}</span>
                    </div>
                    <h5 class="mb-2 text-dark fw-bold">{{ $dokumen->judul }}</h5>
                    <div class="d-flex flex-wrap mb-3 small text-muted">
                        <div class="me-4"><strong>Status:</strong> <span
                                class="badge bg-success">{{ $dokumen->status }}</span></div>
                        <div class="me-4"><strong>Ditetapkan:</strong> {{ $dokumen->tanggal_ditetapkan }}</div>
                        <div><strong>Diundangkan:</strong> {{ $dokumen->tanggal_diundangkan }}</div>
                    </div>
                    <p class="text-muted">{{ $dokumen->deskripsi }}</p>
                    <div class="col-md-8">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td class="fw-semibold col-md-5">Jenis Peraturan</td>
                                    <td class="col-md-1">:</td>
                                    <td class="col-md-6">
                                        <span class="badge bg-primary">{{ $jenisDocuments->nama }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold col-md-5">Singkatan Jenis </td>
                                    <td class="col-md-1">:</td>
                                    <td class="col-md-6">{{$dokumen->singkatan_jenis}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold col-md-5">Judul Peraturan</td>
                                    <td class="col-md-1">:</td>
                                    <td class="col-md-6">{{$dokumen->judul}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold col-md-5">Nomor Peraturan</td>
                                    <td class="col-md-1">:</td>
                                    <td class="col-md-6">{{$dokumen->nomor}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold col-md-5">Tahun Peraturan</td>
                                    <td class="col-md-1">:</td>
                                    <td class="col-md-6">{{$dokumen->tahun}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold col-md-5">T.E.U. Badan</td>
                                    <td class="col-md-1">:</td>
                                    <td class="col-md-6">{{$dokumen->teu}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold col-md-5">SKPD Pengusung</td>
                                    <td class="col-md-1">:</td>
                                    <td class="col-md-6">{{$dokumen->tempat_terbit}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold col-md-5">Tempat Penetapan</td>
                                    <td class="col-md-1">:</td>
                                    <td class="col-md-6">{{$dokumen->sumber}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold col-md-5">Tanggal Penetapan</td>
                                    <td class="col-md-1 text-center">:</td>
                                    <td class="col-md-6">
                                        {{ \Carbon\Carbon::parse($dokumen->tgl_penetapan)->translatedFormat('d F Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold col-md-5">Tanggal Pengundangan</td>
                                    <td class="col-md-1 text-center">:</td>
                                    <td class="col-md-6">
                                        {{ \Carbon\Carbon::parse($dokumen->tgl_pengundangan)->translatedFormat('d F Y') }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="fw-semibold col-md-5">Status</td>
                                    <td class="col-md-1">:</td>
                                    <td class="col-md-6">
                                        <div class="me-4"> <span class="badge bg-success">{{ $dokumen->status }}</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold col-md-5">Subjek Peraturan</td>
                                    <td class="col-md-1">:</td>
                                    <td class="col-md-6">
                                        <a href="/tema/pemerintahan"
                                            class="label label-primary">{{$dokumen->subyek}}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold col-md-5">Bahasa</td>
                                    <td class="col-md-1">:</td>
                                    <td class="col-md-6">
                                        {{$dokumen->bahasa}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold col-md-5">Abstrak Peraturan</td>
                                    <td class="col-md-1">:</td>
                                    <td class="col-md-6">
                                        <a href="{{ asset('storage/' . $dokumen->abstrak) }}" class="main-color"
                                            style="cursor: pointer;">Abstrak</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="fw-semibold col-md-5">Penandatangan</td>
                                    <td class="col-md-1">:</td>
                                    <td class="col-md-6">
                                        {{$dokumen->penandatanganan}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>
@endsection