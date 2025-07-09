@extends('layouts.frontend')

@section('frontend-page')
<!-- HERO SECTION -->
<div class="main-banner d-flex align-items-center justify-content-center text-center text-white position-relative"
    style="min-height: 100vh; background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('/front-end/assets/images/banner-bg.jpg') center center / cover no-repeat;">
    <div class="container">
        <div class="row justify-content-center top-text header-text">
            <div class="col-lg-10">
                <div class="hero-content py-5 px-3">
                    <h6 class="text-uppercase fw-bold mb-3" style="letter-spacing: 2px;">BIRO HUKUM SETDA PROVINSI JAMBI
                    </h6>
                    <h1 class="display-5 fw-bold mb-4">JARINGAN DOKUMENTASI DAN INFORMASI HUKUM</h1>
                    <p class="lead mb-4 text-white">Portal informasi resmi terkait produk hukum Pemerintah Provinsi
                        Jambi. Temukan dokumen, peraturan, dan keputusan hukum terbaru dengan mudah dan cepat.</p>
                    <a href="#produk" class="btn btn-danger btn-lg px-5 py-2 fw-semibold rounded-pill shadow-sm">
                        🔍 Telusuri Produk Hukum
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<section id="produk" class=" position-relative" style="padding: 180px 20px; color: white; overflow: hidden;">
    <!-- Carousel Background -->
    <div id="carouselBackground" class="carousel slide carousel-fade position-absolute top-0 start-0 w-100 h-100"
        data-bs-ride="carousel" data-bs-interval="5000" style="z-index: 0;">
        <div class="carousel-inner h-100">
            <div class="carousel-item active h-100">
                <img src="/front-end/assets/images/bg-2.jpg" class="d-block w-100 h-100 object-fit-cover"
                    alt="Background 1">
            </div>
            <div class="carousel-item h-100">
                <img src="/front-end/assets/images/bg-2.jpg" class="d-block w-100 h-100 object-fit-cover"
                    alt="Background 2">
            </div>
            <div class="carousel-item h-100">
                <img src="/front-end/assets/images/bg-1.jpg" class="d-block w-100 h-100 object-fit-cover"
                    alt="Background 3">
            </div>
        </div>
    </div>

    <!-- Konten -->
    <div class="container position-relative" style="z-index: 2;">
        <div class="row">
            <div class="d-flex flex-wrap align-items-center justify-content-between"
                style="gap: 40px; max-width: 1200px; margin: 0 auto;">

                <!-- Form Pencarian -->
                <div style="flex: 1 1 60%; max-width: 700px;">
                    <h1 style="font-size: 2.8rem; font-weight: 800; margin-bottom: 30px;">
                        <span style="color: #ff3c2f;">CARI</span> PRODUK HUKUM
                    </h1>
                    <form method="GET" action="{{ route('index') }}"
                        style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; background: rgba(0, 0, 0, 0.4); padding: 24px; border-radius: 12px;">
                        @csrf

                        <!-- Kata Kunci -->
                        <div style="grid-column: span 2;">
                            <label for="kata_kunci">Kata Kunci</label>
                            <input type="text" name="kata_kunci" id="kata_kunci" class="form-control"
                                placeholder="Contoh: covid-19" />
                        </div>

                        <!-- Jenis Dokumen -->
                        <div>
                            <label for="area">Jenis Dokumen</label>
                            <select name="area" id="area" class="form-select">
                                <option selected disabled>Pilih Jenis Dokumen</option>
                                @foreach ($jenisDokumen as $jenis)
                                <option value="{{ $jenis->nama }}">{{ $jenis->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tahun -->
                        <div>
                            <label for="tahun">Tahun</label>
                            <select name="tahun" id="tahun" class="form-select">
                                <option selected disabled>Pilih Tahun</option>
                                @for ($year = date('Y'); $year >= 2000; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Nomor -->
                        <div>
                            <label for="nomor">Nomor</label>
                            <input type="text" name="nomor" id="nomor" class="form-control" placeholder="Nomor" />
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option selected disabled>Pilih Status</option>
                                <option value="Berlaku">Berlaku</option>
                                <option value="Tidak Berlaku">Tidak Berlaku</option>
                            </select>
                        </div>

                        <!-- Tombol Cari -->
                        <div style="grid-column: span 2;">
                            <button type="submit" class="btn btn-danger w-100"
                                style="padding: 12px; font-weight: bold;">
                                🔍 CARI
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Logo dan Info -->
                <div style="flex: 1 1 35%; text-align: center;">
                    <img src="/front-end/assets/images/logo-jambi.png" alt="Logo Kota Jambi"
                        style="max-width: 180px; margin-bottom: 20px;" />
                    <h2 style="font-size: 1.6rem; font-weight: 600;">Bagian Hukum<br>Sekretariat Daerah Kota Jambi
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Hasil Pencarian -->
    @if(request()->has('nomor') || request()->has('tahun') || request()->has('area'))
    @if(isset($searchResults) && $searchResults->count())
    <div class="container mt-5 position-relative" style="z-index: 2;">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <style>
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

                    .table-hover tbody tr:hover {
                        background-color: #f1f1f1;
                    }

                    .table th {
                        background-color: #007bff;
                        color: #fff;
                        text-align: center;
                        font-weight: bold;
                    }

                    .table td {
                        text-align: center;
                        vertical-align: middle;
                        padding: 12px 15px;
                    }

                    .btn-primary {
                        background-color: #007bff;
                        border-color: #007bff;
                        padding: 8px 15px;
                    }

                    .btn-primary:hover {
                        background-color: #0056b3;
                        border-color: #004085;
                    }

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
    <div class="container mt-5 position-relative" style="z-index: 2;">
        <div class="alert alert-warning">Tidak ada hasil ditemukan.</div>
    </div>
    @endif
    @endif
</section>
<section style="background-color: #2d2d2d; padding: 50px 0;">
    <div style="text-align: center; color: white; margin-bottom: 40px;">
        <h2 style="font-size: 2.5rem; font-weight: bold;">
            Statistik <span style="color: #ff3c2f;">Produk Hukum</span>
        </h2>
        <div style="width: 100px; height: 4px; background-color: #ff3c2f; margin: 10px auto 0;"></div>
    </div>

    <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 30px;">
        @foreach($statistik as $nama => $jumlah)
        <div
            style="background-color: white; border-radius: 16px; padding: 40px 20px; width: 220px; text-align: center;">
            <div style="font-size: 48px; color: #ff3c2f;">
                @if(str_contains(strtolower($nama), 'gubernur')) 🏛️
                @elseif(str_contains(strtolower($nama), 'daerah')) ⚖️
                @else 📑
                @endif
            </div>
            <div style="font-size: 48px; font-weight: bold; color: #333;">{{ $jumlah }}</div>
            <div style="color: #555; margin-top: 8px;">{{ $nama }}</div>
        </div>
        @endforeach

        <div
            style="background-color: white; border-radius: 16px; padding: 40px 20px; width: 220px; text-align: center;">
            <div style="font-size: 48px; color: #ff3c2f;">📈</div>
            <div style="font-size: 48px; font-weight: bold; color: #333;">{{ $total }}</div>
            <div style="color: #555; margin-top: 8px;">Total Produk Hukum</div>
        </div>
    </div>
</section>

<section style="padding: 60px 20px; background-color: #f9f9f9;">
    <div style="max-width: 1200px; margin: auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
            <div>
                <h2 style="font-size: 2.5rem; font-weight: bold;">
                    <span style="color: #ff3c2f;">Produk Hukum</span> Terbaru
                </h2>
                <div style="width: 100px; height: 4px; background-color: #ff3c2f; margin-top: 8px;"></div>
            </div>
            <a href="#"
                style="background-color: #ff3c2f; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 600;">
                SEMUA PRODUK HUKUM →
            </a>
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 24px; margin-top: 40px;">
            @foreach($dokumenTerbaru as $dok)
            <a href="{{ route('produk.detail', ['id' => $dok->id]) }}"
                style="text-decoration: none; color: inherit; flex: 1 1 30%; min-width: 280px;">
                <div
                    style="background: white; border-radius: 16px; padding: 24px; box-shadow: 0 2px 6px rgba(0,0,0,0.05); transition: 0.3s ease;">
                    <span
                        style="background: #ff3c2f; color: white; font-size: 13px; padding: 4px 10px; border-radius: 20px;">
                        {{ $dok->jenisDokumen->nama ?? '-' }}
                    </span>
                    <h3 style="font-size: 18px; font-weight: bold; margin-top: 12px;">
                        {{ $dok->jenisDokumen->nama ?? '-' }} No. {{ $dok->nomor }} Tahun {{ $dok->tahun }}
                    </h3>
                    <p style="color: #555; font-size: 14px; margin-top: 8px;">
                        {{ \Illuminate\Support\Str::limit($dok->judul, 120) }}
                    </p>
                    <div style="margin-top: 16px; display: flex; gap: 16px; color: #444; font-size: 14px;">
                        <span>👁️ {{ rand(20, 200) }}</span>
                        <span>📥 {{ rand(5, 50) }}</span>
                    </div>
                </div>
            </a>
            @endforeach

            <div style="margin-top: 40px; text-align: center; width: 100%;">
                {{ $dokumenTerbaru->links('vendor.paginate.custom') }}
            </div>
        </div>
    </div>
</section>

<section style="padding: 60px 20px;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
            <div>
                <h2 style="font-size: 2.5rem; font-weight: bold; margin: 0;">
                    <span style="color: #ff3c2f;">Grafik</span> Produk Hukum
                </h2>
                <div style="width: 100px; height: 4px; background-color: #ff3c2f; margin-top: 8px;"></div>
            </div>
            <a href="#"
                style="background-color: #ff3c2f; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 600;">
                LIHAT STATISTIK LAINNYA →
            </a>
        </div>

        <!-- Chart Container -->
        <div
            style="background-color: #fff; border-radius: 12px; padding: 30px; margin-top: 40px; box-shadow: 0 3px 12px rgba(0,0,0,0.08);">
            <canvas id="produkHukumChart" height="100"></canvas>
        </div>
    </div>
</section>



<section style="padding: 60px 20px;" id="berita">
    <div style="max-width: 1200px; margin: 0 auto;">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
            <div>
                <h2 style="font-size: 2.5rem; font-weight: bold; margin: 0;">
                    <span style="color: #ff3c2f;">Berita</span> Terbaru
                </h2>
                <div style="width: 100px; height: 4px; background-color: #ff3c2f; margin-top: 8px;"></div>
            </div>
            <a href="#"
                style="background-color: #ff3c2f; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-weight: 600;">
                SEMUA BERITA →
            </a>
        </div>

        <!-- Berita Grid -->
        <div style="display: flex; flex-wrap: wrap; gap: 24px; margin-top: 40px;">
            @foreach($beritaTerbaru as $berita)
            <div
                style="background: white; border-radius: 16px; overflow: hidden; flex: 1 1 30%; min-width: 280px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                <img src="{{ asset('uploads/berita/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                    style="width: 100%; height: 200px; object-fit: cover;">
                <div style="padding: 20px;">
                    <div style="color: #555; font-size: 14px; margin-bottom: 8px;">
                        📅 {{ \Carbon\Carbon::parse($berita->tanggal)->format('d F Y') }}
                    </div>
                    <h3 style="font-size: 18px; font-weight: bold; margin: 0;">
                        {{ \Illuminate\Support\Str::limit($berita->judul, 60) }}
                    </h3>
                    <p style="font-size: 14px; color: #555; margin: 10px 0;">
                        {{ \Illuminate\Support\Str::limit(strip_tags($berita->isi), 120) }}
                    </p>
                    <a href="{{ route('frontend.berita.show', $berita->id) }}"
                        style="color: #ff3c2f; font-weight: 500; text-decoration: none;">
                        Baca selengkapnya →
                    </a>
                </div>
            </div>
            @endforeach
            <div style="margin-top: 40px; text-align: center; width: 100%;">
                {{ $beritaTerbaru->links('vendor.paginate.custom') }}
            </div>
        </div>
    </div>
</section>






<!-- Script Chart.js (CDN & Example Data) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('produkHukumChart').getContext('2d');

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json(array_reverse($years)), // Tahun: ['2025', '2024', ...]
            datasets: @json($chartData) // Dataset per jenis dokumen
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                title: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });
</script>
@endsection