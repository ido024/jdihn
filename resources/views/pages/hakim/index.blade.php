@extends('layouts.admin')

@section('breadcump-content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Menu Master Hakim Terdata</h4>
            <div class="pt-2">
                <a class="btn btn-primary" href="{{route('dashboard.hakim.create')}}" role="button">Buat Data
                    Hakim Baru +</a>
            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Hakim</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('admin-content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Master Hakim </h4>

                <div class="table-responsive">
                    <table id="complex_head_col" class="table table-striped table-bordered display responsive"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th rowspan="2">ID Hakim</th>
                                <th colspan="5" class="text-center">Detail Informasi Hakim</th>
                                <th rowspan="0">Aksi</th>
                            </tr>
                            <tr>
                                <th>Nama Hakim</th>
                                <th>Nomor Telepon</th>
                                <th>Alamat Hakim</th>
                                <th>Email Hakim</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hakims as $hakim)
                            <tr>
                                <td>00{{$hakim->id}}</td>
                                <td>{{$hakim->nama_hakim}}</td>
                                <td>{{$hakim->nomor_telepon}}</td>
                                <td>{{$hakim->alamat_hakim}}</td>
                                <td>{{$hakim->email_hakim}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{route('dashboard.hakim.edit' , $hakim->id)}}"
                                            class="btn btn-sm btn-primary text-white">Edit</a>
                                        <form action="{{ route('dashboard.hakim.destroy', $hakim->id) }}" method="POST"
                                            style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger text-white"
                                                style="margin-left: 5px; border-top-left-radius: 0; border-bottom-left-radius: 0;"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus hakim ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                                <td></td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection