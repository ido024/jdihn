@extends('layouts.admin')

@section('breadcump-content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Menu Pembuatan Data Catatan Perkara Baru</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Catatan Perkara</li>
                        <li class="breadcrumb-item active" aria-current="page">Buat Catatan Perkara Baru</li>
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
            <form action="{{route('dashboard.catatanperkara.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <h4 class="card-title">Buat Data Catatan Perkara</h4>
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
                            <label for="inputEmail3" class="control-label col-form-label">Buat Nomor Putusan
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fas fa-address-card"></i></span>
                                </div>
                                <input type="text" id="no_putusan" name="no_putusan" class="form-control"
                                    placeholder="Masukan Nomor Putusan" maxlength="35" required>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="inputEmail3" class="control-label col-form-label">Cari No Pelimpahan
                                </label>
                                <div class="input-group">

                                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;"
                                        name="perkara_id" aria-label="Username" aria-describedby="basic-addon1"
                                        aria-describedby="basic-addon1">
                                        <option>Cari No Pelimpahan</option>
                                        <optgroup label="Nomor Tuntuan Terdata">
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

                        <div class="col-sm-12 ">
                            <div class="form-group">
                                <label for="inputEmail3" class="control-label col-form-label">Pilih Jaksa
                                    Penuntut Umum</label>
                                <div class="input-group">

                                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;"
                                        name="jaksa_id" aria-label="Username" aria-describedby="basic-addon1"
                                        aria-describedby="basic-addon1">
                                        <option>Pilih Jaksa</option>

                                        @foreach ($jaksas as $jaksa)
                                        <option value="{{$jaksa->id}}">{{$jaksa->nama_jaksa}}</option>
                                        @endforeach


                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="inputEmail3" class="control-label col-form-label">Tanggal Putusan
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon11"><i
                                                class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="date" class="form-control" placeholder="Tanggal Putusan "
                                        name="tgl_catatan" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="form-group">
                                <label for="inputEmail3" class="control-label col-form-label">Isi Putusan
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon11"><i
                                                class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Isi Putusan " name="isicatatan"
                                        aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="inputEmail3" class="control-label col-form-label">Dokumen Putusan
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon11"><i
                                                class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="file" class="form-control" placeholder="Masukan File Dokumen Putusan  "
                                        name="file_1" aria-label="Username" aria-describedby="basic-addon1">
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