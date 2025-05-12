@extends('layouts.frontend')

@section('frontend-page')
<div class="main-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="top-text header-text">
                    <h6>BIRO HUKUM SETDA PROVINSI JAMBI</h6>
                    <h2>JARINGAN DOKUMENTASI DAN INFORMASI HUKUM</h2>
                </div>
            </div>
            <div class="col-lg-12">
                <form id="search-form" name="gs" method="GET" action="{{ route('index') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-3 align-self-center">
                            <fieldset>
                                <select name="area" class="form-select" aria-label="Area" id="chooseCategory">
                                    <option selected disabled>Jenis Dokumen</option>
                                    @foreach ($jenisDokumen as $jenis)
                                    <option value="{{ $jenis->nama }}">{{ $jenis->nama }}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-lg-3 align-self-center">
                            <fieldset>
                                <input type="number" name="nomor" class="searchText" placeholder="Nomor"
                                    autocomplete="on">
                            </fieldset>
                        </div>
                        <div class="col-lg-3 align-self-center">
                            <fieldset>
                                <select name="tahun" class="form-select" aria-label="Default select example"
                                    id="chooseCategory">
                                    <option selected disabled>Tahun</option>
                                    @for ($year = 2025; $year >= 2000; $year--)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-lg-3">
                            <fieldset>
                                <button class="main-button"><i class="fa fa-search"></i> Cari</button>
                            </fieldset>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Menampilkan tabel hanya jika ada hasil pencarian --}}
            @if(request()->has('nomor') || request()->has('tahun') || request()->has('area'))
            @if(isset($searchResults) && $searchResults->count())
            <div class="col-lg-12 mt-4">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <style>
                            /* Styling untuk tabel */
                            .table-dark {
                                background-color: #343a40;
                                color: #fff;
                            }

                            .table {
                                background-color: #fff;
                                font-size: 14px;
                                border: 1px solid #ddd;
                                border-radius: 5px;
                            }

                            /* Menambahkan hover efek pada setiap baris */
                            .table-hover tbody tr:hover {
                                background-color: #f1f1f1;
                            }

                            /* Styling untuk header tabel */
                            .table th {
                                background-color: #007bff;
                                color: #fff;
                                text-align: center;
                                font-weight: bold;
                            }

                            /* Styling untuk sel tabel */
                            .table td {
                                text-align: center;
                                vertical-align: middle;
                                padding: 12px 15px;
                            }

                            /* Memberikan efek hover pada tombol */
                            .btn-primary {
                                background-color: #007bff;
                                border-color: #007bff;
                                padding: 8px 15px;
                            }

                            .btn-primary:hover {
                                background-color: #0056b3;
                                border-color: #004085;
                            }

                            /* Styling untuk alert jika tidak ada hasil */
                            .alert-warning {
                                font-size: 16px;
                                padding: 15px;
                                margin-top: 20px;
                            }

                        </style>
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Jenis Dokumen</th>
                                <th>Nomor</th>
                                <th>Tahun</th>
                                <th>Judul</th>
                                <th>Dokumen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($searchResults as $index => $dok)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $dok->jenisDokumen->nama ?? '-' }}</td>
                                <td>{{ $dok->nomor }}</td>
                                <td>{{ $dok->tahun }}</td>
                                <td>{{ $dok->judul }}</td>
                                <td>
                                    @if($dok->document)
                                    <a href="{{ route('produk.detail', ['id' => $dok->id]) }}" class="btn btn-primary"
                                        target="_blank">
                                        Lihat Detail
                                    </a>
                                    @else
                                    Tidak tersedia
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="col-lg-12 mt-4">
                <div class="alert alert-warning">Tidak ada hasil ditemukan.</div>
            </div>
            @endif
            @endif

            {{-- Menampilkan kategori hanya jika ada hasil pencarian --}}

            <div class="col-lg-10 offset-lg-1">
                <ul class="categories">
                    <li><a href="{{route('products')}}"><span class="icon"><img
                                    src="{{asset('../../front-end/assets/images/search-icon-01.png')}}"
                                    alt="Home"></span> Dokumen</a></li>
                    <li><a href="#"><span class="icon"><img
                                    src="{{asset('../../front-end/assets/images/search-icon-02.png')}}"
                                    alt="Food"></span> Dasar Hukum</a></li>
                    <li><a href="#"><span class="icon"><img
                                    src="{{asset('../../front-end/assets/images/search-icon-03.png')}}"
                                    alt="Vehicle"></span> Visi Misi</a></li>
                    <li><a href="#"><span class="icon"><img
                                    src="{{asset('../../front-end/assets/images/search-icon-04.png')}}"
                                    alt="Shopping"></span> Struktur Organisai</a></li>
                    <li><a href="#"><span class="icon"><img
                                    src="{{asset('../../front-end/assets/images/search-icon-05.png')}}"
                                    alt="Travel"></span> Struktur JDIH </a></li>
                </ul>
            </div>

        </div>
    </div>
</div>


@endsection