@extends('layouts.admin')

@section('breadcump-content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Dashboard</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('admin-content')
<div class="card-group">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <i class="mdi mdi-archive font-20 text-muted"></i>
                            <p class="font-16 m-b-5">Total Dokumen Tersedia</p>
                        </div>
                        <div class="ml-auto">
                            <h1 class="font-light text-right">{{ $totalDokumen }}</h1> <!-- Total dokumen -->
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="progress">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 75%; height: 6px;"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <i class="mdi mdi-harddisk font-20 text-muted"></i>
                            <p class="font-16 m-b-5">Data Storage Dokumen</p>
                        </div>
                        <div class="ml-auto">
                            <!-- Konversi total ukuran ke GB jika lebih besar dari 1000000 KB -->
                            @if($totalSizeDokumen >= 1000000)
                            <h1 class="font-16 text-right">{{ round($totalSizeDokumen / 1000000, 2) }}GB/1000GB</h1>
                            <!-- Konversi total ukuran ke MB jika lebih besar dari 1000 KB -->
                            @elseif($totalSizeDokumen >= 1000)
                            <h1 class="font-16 text-right">{{ round($totalSizeDokumen / 1000, 2) }}MB/1000GB</h1>
                            <!-- Tampilkan dalam KB jika total kurang dari 1000 KB -->
                            @else
                            <h1 class="font-16 text-right">{{ $totalSizeDokumen }}KB/1000GB</h1>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="progress">
                        <!-- Menyesuaikan value progress bar dengan ukuran yang telah dikonversi -->
                        <div class="progress-bar bg-success" role="progressbar"
                            style="width: {{ round($totalSizeDokumen / (100 * 1024)) }}%; height: 6px;"
                            aria-valuenow="{{ round($totalSizeDokumen / (100 * 1024)) }}" aria-valuemin="0"
                            aria-valuemax="100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <i class="mdi mdi-briefcase font-20 text-muted"></i>
                            <p class="font-16 m-b-5">Dokumen Per Kategori</p>
                        </div>
                        <div class="ml-auto">
                            <h1 class="font-light text-right">{{ $dokumenKategoriCount }}</h1>
                            <!-- Jumlah dokumen per kategori -->
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="progress">
                        <div class="progress-bar bg-purple" role="progressbar" style="width: 65%; height: 6px;"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex no-block align-items-center">
                        <div>
                            <i class="mdi mdi-file-chart font-20 text-muted"></i>
                            <p class="font-16 m-b-5">Dokumen Pelaporan</p>
                        </div>
                        <div class="ml-auto">
                            <h1 class="font-light text-right">{{ $dokumenPelaporanCount }}</h1>
                            <!-- Jumlah dokumen pelaporan -->
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 70%; height: 6px;"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>







@endsection