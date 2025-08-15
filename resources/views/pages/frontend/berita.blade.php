@extends('layouts.frontend')

@section('frontend-page')
<section style="padding: 60px 20px; background-color: #f3f7fa;">
    <div
        style="max-width: 900px; margin: 0 auto; background: #fff; border-radius: 16px; padding: 40px; box-shadow: 0 4px 12px rgba(0,0,0,0.06);">

        @if($berita->gambar)
        <img src="{{ asset('uploads/berita/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
            style="width: 100%; border-radius: 12px; margin-bottom: 24px;">
        @endif

        <h1 style="font-size: 2rem; font-weight: bold; margin-bottom: 8px;">{{ $berita->judul }}</h1>
        <div style="color: #777; font-size: 14px; margin-bottom: 24px;">
            <span>🖋️ Admin</span> &nbsp; | &nbsp;
            <span>📅 {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}</span>
        </div>

        <div style="font-size: 16px; line-height: 1.8; color: #333;">
            {!! ($berita->isi) !!}
        </div>

        <hr style="margin: 40px 0;">

        <div style="font-size: 15px; color: #444;">
            <p>Tim Pengelola Website JDIH Provinsi Jambi</p>
        </div>

        <div style="margin-top: 24px;">
            <a href="{{ route('index') }}" style="text-decoration: none; color: #ff3c2f; font-weight: 600;">← Kembali ke
                Daftar Berita</a>
        </div>

    </div>
</section>
@endsection