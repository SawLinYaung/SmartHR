@extends('layouts.app_plain')
@section('title','Login')
@section('extra_css')
    <style>
        
    </style>
@endsection
@section('content')
<div class="container" style="min-height:100vh" >
    <div class="row justify-content-center align-content-center" style="min-height:100vh" >
        <div class="row justify-content-center align-content-center"
        style = "box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24) !important;
                 transition: all 0.3s cubic-bezier(.25,.8,.25,1) !important;"
        >
            <div class="col-lg-6 col-md-12 col-sm-12 logo-part" style="background:#484c7f;padding:20px;">
                <img src="{{asset('image/login.svg')}}" alt="wrong_photo" style="width:100%">
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 align-content-center" style="padding:20px;border-radius:30px;">
                <div class="">
                        <div class="">
                        <h5 class="text-center" style="font-family: 'Josefin Sans', sans-serif !important;font-weight:bold;font-size:28px;font-style:italic">Smart HR </h5>
                            <img src="{{asset('image/project_logo.png')}}" alt=" wrong-image" style="width:100px;margin-left:30%;">
                            <!-- <p class="text-muted text-center">Please fill the login form</p> -->
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>

                                    @error('phone')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required>   

                                    @error('password')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                
                                <button type="submit" class="btn login-btn" style="background:#484c7f;color:#fff">Login</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
       
</div>
    <!-- <div class="row justify-content-center align-content-center" style="height:100vh;">
        <div class="col-md-6">
            <div class="text-center mb-3">
                <img src="{{asset('image/project_logo.png')}}" alt="Smart HR" style="width:200px;">
            </div>
            <div class="card">
                 <div class="card-body">
                    <h5 class ="text-center">Login</h5>
                    <p class="text-muted text-center">Please fill the login form</p>
              
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="number" class="form-control  @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autofocus>

                            @error('phone')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="md-form">
                            <label for="">Password</label>
                            <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required>   

                            @error('password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-theme form-control" style="background:#484c7f"></button>
                    </form>

                </div>
            </div>
        </div>
    </div> -->
</div>
@endsection
