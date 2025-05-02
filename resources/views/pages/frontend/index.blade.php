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


{{-- <div class="popular-categories">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Berita Terbaru</h2>
                    <h6>Cek disini</h6>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="naccs">
                    <div class="grid">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="menu">
                                    <div class="first-thumb active">
                                        <div class="thumb">
                                            <span class="icon"><img
                                                    src="{{asset('../front-end/assets/images/search-icon-01.png')}}"
alt=""></span>
Apartments
</div>
</div>
<div>
    <div class="thumb">
        <span class="icon"><img src="{{asset('../front-end/assets/images/search-icon-02.png')}}" alt=""></span>
        Food &amp; Life
    </div>
</div>
<div>
    <div class="thumb">
        <span class="icon"><img src="{{asset('../front-end/assets/images/search-icon-03.png')}}" alt=""></span>
        Cars
    </div>
</div>
<div>
    <div class="thumb">
        <span class="icon"><img src="{{asset('../front-end/assets/images/search-icon-04.png')}}" alt=""></span>
        Shopping
    </div>
</div>
<div class="last-thumb">
    <div class="thumb">
        <span class="icon"><img src="{{asset('../front-end/assets/images/search-icon-05.png')}}" alt=""></span>
        Traveling
    </div>
</div>
</div>
</div>
<div class="col-lg-9 align-self-center">
    <ul class="nacc">
        <li class="active">
            <div>
                <div class="thumb">
                    <div class="row">
                        <div class="col-lg-5 align-self-center">
                            <div class="left-text">
                                <h4>One Of The Most Trending Stuffs Right Now!</h4>
                                <p>Plot Listing is a responsive Bootstrap 5 website
                                    template that included 4 different HTML pages.
                                    This template is provided by TemplateMo website.
                                    You can apply this layout for your static or
                                    dynamic CMS websites.</p>
                                <div class="main-white-button"><a href="#"><i class="fa fa-eye"></i> Discover More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 align-self-center">
                            <div class="right-image">
                                <img src="{{asset('../front-end/assets/images/tabs-image-01.jpg')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div>
                <div class="thumb">
                    <div class="row">
                        <div class="col-lg-5 align-self-center">
                            <div class="left-text">
                                <h4>Food and Lifestyle category is here</h4>
                                <p>You can feel free to download, edit and apply
                                    this template for your website. Please tell your
                                    friends about TemplateMo website.</p>
                                <div class="main-white-button"><a href="#"><i class="fa fa-eye"></i> Explore More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 align-self-center">
                            <div class="right-image">
                                <img src="{{asset('../front-end/assets/images/tabs-image-02.jpg')}}"
                                    alt="Foods on the table">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div>
                <div class="thumb">
                    <div class="row">
                        <div class="col-lg-5 align-self-center">
                            <div class="left-text">
                                <h4>Best car rentals for your trips!</h4>
                                <p>Did you know? You can get the best free HTML
                                    templates on Too CSS blog. Visit the blog pages
                                    and explore fresh and latest website templates.
                                </p>
                                <div class="main-white-button"><a href="listing.html"><i class="fa fa-eye"></i> More
                                        Listing</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 align-self-center">
                            <div class="right-image">
                                <img src="{{asset('../front-end/assets/images/tabs-image-03.jpg')}}"
                                    alt="cars in the city">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div>
                <div class="thumb">
                    <div class="row">
                        <div class="col-lg-5 align-self-center">
                            <div class="left-text">
                                <h4>Shopping List: Images from Unsplash</h4>
                                <p>Image credits go to Unsplash website that
                                    provides free stock photos for anyone. Images
                                    used in this Plot Listing template are from
                                    Unsplash.</p>
                                <div class="main-white-button"><a href="#"><i class="fa fa-eye"></i> Discover More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 align-self-center">
                            <div class="right-image">
                                <img src="{{asset('../front-end/assets/images/tabs-image-04.jpg')}}"
                                    alt="Shopping Girl">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div>
                <div class="thumb">
                    <div class="row">
                        <div class="col-lg-5 align-self-center">
                            <div class="left-text">
                                <h4>Information and Safety Tips for Traveling</h4>
                                <p>You are allowed to use this template for your
                                    commercial websites. You are NOT allowed to
                                    redistribute this template ZIP file on any Free
                                    CSS collection websites.</p>
                                <div class="main-white-button"><a rel="nofollow"
                                        href="https://templatemo.com/contact"><i class="fa fa-eye"></i> Read More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 align-self-center">
                            <div class="right-image">
                                <img src="{{asset('../front-end/assets/images/tabs-image-05.jpg')}}"
                                    alt="Traveling Beach">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div> --}}


{{-- <div class="recent-listing">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Recent Listing</h2>
                    <h6>Check Them Out</h6>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="owl-carousel owl-listing">
                    <div class="item">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="listing-item">
                                    <div class="left-image">
                                        <a href="#"><img src="assets/images/listing-01.jpg" alt=""></a>
                                    </div>
                                    <div class="right-content align-self-center">
                                        <a href="#">
                                            <h4>1. First Apartment Unit</h4>
                                        </a>
                                        <h6>by: Sale Agent</h6>
                                        <ul class="rate">
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li>(18) Reviews</li>
                                        </ul>
                                        <span class="price">
                                            <div class="icon"><img
                                                    src="{{asset('../front-end/assets/images/listing-icon-01.png')}}"
alt=""></div>
$450 - $950 / month with taxes
</span>
<span class="details">Details: <em>2760 sq ft</em></span>
<ul class="info">
    <li><img src="{{asset('../front-end/assets/images/listing-icon-02.png')}}" alt=""> 4 Bedrooms
    </li>
    <li><img src="{{asset('../front-end/assets/images/listing-icon-03.png')}}" alt=""> 4 Bathrooms
    </li>
</ul>
<div class="main-white-button">
    <a href="contact.html"><i class="fa fa-eye"></i> Contact Now</a>
</div>
</div>
</div>
</div>
<div class="col-lg-12">
    <div class="listing-item">
        <div class="left-image">
            <a href="#"><img src="assets/images/listing-02.jpg" alt=""></a>
        </div>
        <div class="right-content align-self-center">
            <a href="#">
                <h4>2. Another House of Gaming</h4>
            </a>
            <h6>by: Top Sale Agent</h6>
            <ul class="rate">
                <li><i class="fa fa-star-o"></i></li>
                <li><i class="fa fa-star-o"></i></li>
                <li><i class="fa fa-star-o"></i></li>
                <li><i class="fa fa-star-o"></i></li>
                <li><i class="fa fa-star-o"></i></li>
                <li>(24) Reviews</li>
            </ul>
            <span class="price">
                <div class="icon"><img src="{{asset('../front-end/assets/images/listing-icon-01.png')}}" alt=""></div>
                $1,400 - $3,500 / month with taxes
            </span>
            <span class="details">Details: <em>3650 sq ft</em></span>
            <ul class="info">
                <li><img src="{{asset('../front-end/assets/images/listing-icon-02.png')}}" alt=""> 4 Bedrooms
                </li>
                <li><img src="{{asset('../front-end/assets/images/listing-icon-03.png')}}" alt=""> 3 Bathrooms
                </li>
            </ul>
            <div class="main-white-button">
                <a href="contact.html"><i class="fa fa-eye"></i> Contact Now</a>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="listing-item">
        <div class="left-image">
            <a href="#"><img src="assets/images/listing-03.jpg" alt=""></a>
        </div>
        <div class="right-content align-self-center">
            <a href="#">
                <h4>3. Secret Place Hidden House</h4>
            </a>
            <h6>by: Best Property</h6>
            <ul class="rate">
                <li><i class="fa fa-star-o"></i></li>
                <li><i class="fa fa-star-o"></i></li>
                <li><i class="fa fa-star-o"></i></li>
                <li><i class="fa fa-star-o"></i></li>
                <li><i class="fa fa-star-o"></i></li>
                <li>(36) Reviews</li>
            </ul>
            <span class="price">
                <div class="icon"><img src="assets/images/listing-icon-01.png" alt=""></div>
                $1,500 - $3,600 / month with taxes
            </span>
            <span class="details">Details: <em>5500 sq ft</em></span>
            <ul class="info">
                <li><img src="assets/images/listing-icon-02.png" alt=""> 4 Bedrooms
                </li>
                <li><img src="assets/images/listing-icon-03.png" alt=""> 3 Bathrooms
                </li>
            </ul>
            <div class="main-white-button">
                <a href="contact.html"><i class="fa fa-eye"></i> Contact Now</a>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="item">
    <div class="row">
        <div class="col-lg-12">
            <div class="listing-item">
                <div class="left-image">
                    <a href="#"><img src="assets/images/listing-04.jpg" alt=""></a>
                </div>
                <div class="right-content align-self-center">
                    <a href="#">
                        <h4>4. Sunshine Fourth Apartment</h4>
                    </a>
                    <h6>by: Sale Agent</h6>
                    <ul class="rate">
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li>(24) Reviews</li>
                    </ul>
                    <span class="price">
                        <div class="icon"><img src="assets/images/listing-icon-01.png" alt=""></div>
                        $3,600 / month with taxes
                    </span>
                    <span class="details">Details: <em>3660 sq ft</em></span>
                    <ul class="info">
                        <li><img src="assets/images/listing-icon-02.png" alt=""> 5 Bedrooms
                        </li>
                        <li><img src="assets/images/listing-icon-03.png" alt=""> 3 Bathrooms
                        </li>
                    </ul>
                    <div class="main-white-button">
                        <a href="contact.html"><i class="fa fa-eye"></i> Contact Now</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="item">
    <div class="row">
        <div class="col-lg-12">
            <div class="listing-item">
                <div class="left-image">
                    <a href="#"><img src="assets/images/listing-05.jpg" alt=""></a>
                </div>
                <div class="right-content align-self-center">
                    <a href="#">
                        <h4>7. Sunny Apartment</h4>
                    </a>
                    <h6>by: Sale Agent</h6>
                    <ul class="rate">
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li>(24) Reviews</li>
                    </ul>
                    <span class="price">
                        <div class="icon"><img src="assets/images/listing-icon-01.png" alt=""></div>
                        $5,450 / month with taxes
                    </span>
                    <span class="details">Details: <em>1640 sq ft</em></span>
                    <ul class="info">
                        <li><img src="assets/images/listing-icon-02.png" alt=""> 8 Bedrooms
                        </li>
                        <li><img src="assets/images/listing-icon-03.png" alt=""> 5 Bathrooms
                        </li>
                    </ul>
                    <div class="main-white-button">
                        <a href="contact.html"><i class="fa fa-eye"></i> Contact Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="listing-item">
                <div class="left-image">
                    <a href="#"><img src="assets/images/listing-02.jpg" alt=""></a>
                </div>
                <div class="right-content align-self-center">
                    <a href="#">
                        <h4>8. Third House of Gaming</h4>
                    </a>
                    <h6>by: Sale Agent</h6>
                    <ul class="rate">
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li>(15) Reviews</li>
                    </ul>
                    <span class="price">
                        <div class="icon"><img src="assets/images/listing-icon-01.png" alt=""></div>
                        $5,520 / month with taxes
                    </span>
                    <span class="details">Details: <em>1660 sq ft</em></span>
                    <ul class="info">
                        <li><img src="assets/images/listing-icon-02.png" alt=""> 5 Bedrooms
                        </li>
                        <li><img src="assets/images/listing-icon-03.png" alt=""> 4 Bathrooms
                        </li>
                    </ul>
                    <div class="main-white-button">
                        <a href="contact.html"><i class="fa fa-eye"></i> Contact Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="listing-item">
                <div class="left-image">
                    <a href="#"><img src="assets/images/listing-06.jpg" alt=""></a>
                </div>
                <div class="right-content align-self-center">
                    <a href="#">
                        <h4>9. Relaxing BBQ Party Villa</h4>
                    </a>
                    <h6>by: Sale Agent</h6>
                    <ul class="rate">
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li><i class="fa fa-star-o"></i></li>
                        <li>(20) Reviews</li>
                    </ul>
                    <span class="price">
                        <div class="icon"><img src="assets/images/listing-icon-01.png" alt=""></div>
                        $4,760 / month with taxes
                    </span>
                    <span class="details">Details: <em>2880 sq ft</em></span>
                    <ul class="info">
                        <li><img src="assets/images/listing-icon-02.png" alt=""> 6 Bedrooms
                        </li>
                        <li><img src="assets/images/listing-icon-03.png" alt=""> 4 Bathrooms
                        </li>
                    </ul>
                    <div class="main-white-button">
                        <a href="contact.html"><i class="fa fa-eye"></i> Contact Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div> --}}
@endsection