@extends('layouts.admin')

@section('breadcump-content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Menu Pembuatan Data Arsip Baru</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Arsip</li>
                        <li class="breadcrumb-item active" aria-current="page">Buat Arsip Baru</li>
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
            <form action="{{route('dashboard.arsip.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
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
                        <div class="col-12">
                            <div class="form-group">
                                <label for="inputEmail3" class="control-label col-form-label">Pilih Nomor
                                    Perkara</label>
                                <div class="input-group">
                                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;"
                                        aria-label="Username" aria-describedby="basic-addon1" name="perkara_id"
                                        aria-describedby="basic-addon1">
                                        <option>Cari Nomor Perkara</option>
                                        <optgroup label="Nomor Perkara">
                                            @foreach ($perkaras as $perkara)
                                            <option value="{{$perkara->id}}">
                                                {{$perkara->nomor_perkara}}
                                            </option>
                                            @endforeach


                                        </optgroup>

                                    </select>

                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="inputEmail3" class="control-label col-form-label">Tanggal Upload Arsip
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon11"><i
                                                class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="date" class="form-control" placeholder="Tanggal Upload Arsip "
                                        name="tgl_arsip" aria-label="tgl_arsip" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 col-md-4 pt-2">
                                <div class="form-group">
                                    <label for="file_1" class="control-label col-form-label">File 1</label>
                                    <input type="file" class="form-control" id="file_1" name="file_1">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 pt-2">
                                <div class="form-group">
                                    <label for="file_2" class="control-label col-form-label">File 2</label>
                                    <input type="file" class="form-control" id="file_2" name="file_2">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 pt-2">
                                <div class="form-group">
                                    <label for="file_3" class="control-label col-form-label">File 3</label>
                                    <input type="file" class="form-control" id="file_3" name="file_3">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 pt-2">
                                <div class="form-group">
                                    <label for="file_4" class="control-label col-form-label">File 4</label>
                                    <input type="file" class="form-control" id="file_4" name="file_4">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 pt-2">
                                <div class="form-group">
                                    <label for="file_5" class="control-label col-form-label">File 5</label>
                                    <input type="file" class="form-control" id="file_5" name="file_5">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <div class="action-form">
                        <div class="form-group m-b-0 text-left">
                            <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                            <button type="submit" class="btn btn-dark waves-effect waves-light">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection