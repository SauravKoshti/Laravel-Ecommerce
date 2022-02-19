@extends('layouts.admin.app')

@section('content')
<div class="login-box m-auto">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1"><b>Admin</b>Login</a>
      </div>
        <div class="card-body">
            {{-- <p class="login-box-msg">Sign in to start your session</p> --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">

                    @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif

                    <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                    </div>
                </div><br>
                <div class="input-group">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  placeholder="Password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-key"></span>
                        </div>
                    </div>
                </div>
                <div class="row py-3">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember"  id="remember" {{ old('remember') ? 'checked' : '' }}> 
                            <label for="remember">{{ __('Remember Me') }}</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('auth.forgot') }}
                        </a>
                    </div>
                    <div class="d-flex justify-content-start">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
