@extends('layouts.app_plain')
@section('title','Login')
@section('content')
<div class="container">
    <div class="row justify-content-center align-content-center" style="height:100vh;">
        <div class="col-md-6">
            <div class="text-center mb-3">
                <img src="{{asset('image/logo.png')}}" alt="Smart HR" style="width:200px;">
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
                        
                        <button type="submit" class="btn btn-theme form-control">Login</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
