@extends('layouts.auth')
@section('auth-content')
<div class="auth-wrapper d-flex no-block justify-content-center align-items-center"
    style="background:url(../../admin/assets/images/big/auth-bg.jpg) no-repeat center center;">
    <div class="auth-box">
        <div>
            <div class="logo">
                <span class="db"><img src="{{asset('../../admin/assets/images/logo-icon.png')}}" alt="logo" /></span>
                <h5 class="font-medium m-b-20">Sign Up to Admin</h5>
            </div>
            <!-- Form -->
            <div class="row">
                <div class="col-12">
                    <form class="form-horizontal m-t-20" action="{{route('register')}}" method="post">
                        @csrf
                        <div class="form-group row ">
                            <div class="col-12 ">
                                <input class="form-control form-control-lg" type="text" required=" " placeholder="Name"
                                    name="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 ">
                                <input class="form-control form-control-lg" type="text" required=" " placeholder="Email"
                                    name="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 ">
                                <input class="form-control form-control-lg" type="password" required=" " name="password"
                                    placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 ">
                                <input class="form-control form-control-lg" type="password" required=" "
                                    name="password_confirmation" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 ">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">I agree to all <a
                                            href="javascript:void(0)">Terms</a></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center ">
                            <div class="col-xs-12 p-b-20 ">
                                <button class="btn btn-block btn-lg btn-info " type="submit ">Register</button>
                            </div>
                        </div>
                        <div class="form-group m-b-0 m-t-10 ">
                            <div class="col-sm-12 text-center ">
                                Already have an account? <a href="authentication-login1.html "
                                    class="text-info m-l-5 "><b>Sign In</b></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection