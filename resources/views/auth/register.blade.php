@extends('component.layout')

@section('content')
    <div class="authFormBox">
        <form action="{{ route('register') }}" method="post" class="col-md-5">
            @csrf
            @method('post')

            <h5>Create Account</h5>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">

                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">

                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password">

                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Re-type password</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">

                @error('password_confirmation')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-custom btn-block">Register</button>
            </div>
            
            <div class="form-group mt-5 text-center">
                <span>Sign up using</span>

                <div class="social_auth_btn mt-2">
                    <a class="btn social_auth_btn_fb" href="{{ route('auth-facebook') }}">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a class="btn social_auth_btn_google" href="{{ route('auth-google') }}">
                        <i class="fa-brands fa-google"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection
