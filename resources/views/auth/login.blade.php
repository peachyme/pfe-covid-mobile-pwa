@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('/images/bg2.png');
    }
</style>
<div class="col-3 col-sm-2 mb-5 mx-auto " style="margin-top: 160px">
    <img src="/images/logoo.png" alt="wtv" class="img-fluid">
</div>
<div class="position-absolute login-card bottom-0">
    <div class="card border-0">
        <div class="card-header bg-light">{{ __('Se connecter') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row mb-4">
                    <div class="px-4 input-group">
                        <span class="input-group-text custom-form-control" id="basic-addon1">
                            <i class="fa-solid fa-envelope" style="color: #595959"></i>
                        </span>
                        <input id="email" type="email" class="form-control custom-form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="px-4 input-group">
                        <span class="input-group-text custom-form-control" id="basic-addon1">
                            <i class="fa-solid fa-lock" style="color: #595959"></i>
                        </span>
                        <input id="password" type="password" class="form-control custom-form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="mot de passe">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3 ms-3">
                    <div class="form-check">
                        <input class="form-check-input " type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Se souvenir de moi') }}
                        </label>
                    </div>
                </div>

                <div class="row mb-2 px-4">
                    <button type="submit" class="btn btn-light rounded-pill fw-bold">
                        {{ __('Login') }}
                    </button>
                </div>
                <div class="text-center fw-bold">
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié?') }}
                    </a>
                    @endif
                </div>
            </form>
        </div>
        <div class="text-center mt-2 mb-2">
            Vous n'avez pas de compte?
            <a class="btn-link fw-bold" href="{{ route('register') }}">
                {{ __('Créer') }}
            </a>
        </div>
    </div>

</div>
@endsection
