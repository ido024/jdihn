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

<div class="listing-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="naccs">
                    <div class="grid">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="menu">
                                    @foreach($jenisDocuments as $index => $jenis)
                                    <div class="{{ $loop->first ? 'first-thumb active' : '' }}">
                                        <div class="thumb">
                                            <span class="icon">
                                                <img src="{{ asset('front-end/assets/images/search-icon-01.png') }}"
                                                    alt="">
                                            </span>
                                            {{ $jenis->nama }}
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <ul class="nacc">
                                    @foreach($jenisDocuments as $jenis)
                                    <li class="{{ $loop->first ? 'active' : '' }}">
                                        <div>
                                            @foreach($jenis->documents as $dokumen)
                                            <div class="col-lg-12 mb-4">
                                                <div
                                                    class="d-flex flex-column flex-md-row border rounded overflow-hidden shadow-sm bg-light">

                                                    {{-- Iframe Preview (kiri) --}}
                                                    <div class="flex-shrink-0"
                                                        style="width: 300px; height: 350px; overflow: hidden;">
                                                        <iframe
                                                            src="{{ asset('storage/' . $dokumen->document) }}#page=1&zoom=10"
                                                            style="width: 100%; height: 350px;"></iframe>
                                                    </div>

                                                    {{-- Konten Deskripsi (kanan) --}}
                                                    <div class="p-4 d-flex flex-column justify-content-center w-100">

                                                        {{-- Badge --}}
                                                        <div class="mb-2">
                                                            <span class="badge bg-danger">Peraturan
                                                                Daerah</span>
                                                        </div>

                                                        {{-- Judul --}}
                                                        <a href="{{route('produk.detail', $dokumen->id)}}"
                                                            class="text-decoration-none">
                                                            <h5 class="mb-2 text-dark fw-bold">{{$dokumen->judul}}</h5>
                                                        </a>

                                                        {{-- Metadata --}}
                                                        <div class="d-flex flex-wrap mb-3 small text-muted">
                                                            <div class="me-4">
                                                                <strong>Status:</strong>
                                                                <span
                                                                    class="badge bg-success">{{ $dokumen->status ?? '-' }}</span>
                                                            </div>
                                                            <div class="me-4">
                                                                <strong>Ditetapkan:</strong>
                                                                <span class="text-dark fw-normal">
                                                                    {{ $dokumen->tgl_penetapan }}
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <strong>Diundangkan:</strong>
                                                                <span class="text-dark fw-normal">
                                                                    {{ $dokumen->tgl_penetapan }}
                                                                </span>
                                                            </div>
                                                        </div>

                                                        {{-- Statistik --}}
                                                        <div class="mb-2 text-muted small">
                                                            <i class="fa fa-download me-1"></i> 0
                                                            <span class="mx-3">|</span>
                                                            <i class="fa fa-eye me-1"></i> 337
                                                        </div>

                                                        {{-- Deskripsi --}}
                                                        <p class="mb-0 text-medium" style="font-size: 14px;">
                                                            {!! $dokumen->text_document !!}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection