@extends('layouts.app')
@include('partials.nav')

@section('content')
<style>
    body {
        height: 100vh;
        align-items: center;
        justify-content: center;
    }
</style>

<div class="card change-psw-card mx-auto my-5">
    <div class="card-header fw-bold">
        Confirmer mot de passe
        <a href="{{ route('profile.index') }}" type="button" class="btn btn-close btn-sm" aria-label="Close"></a>
    </div>
    <div class="card-body">
        <div class="form">
            <form action="{{ route('password.confirm') }}" method="post">
                @csrf
                <div id="confirmMsg">Veuillez confirmer votre mot de passe avant de continuer.</div>

                <div class="input-field">
                    <i class="fa-solid fa-lock"></i>
                    <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Mot de passe actuel">
                    <div class="eye" onclick="showHideAccess()">
                        <i id="hideAccess" class="fa-regular fa-eye"></i>
                        <i id="showAccess" class="fa-regular fa-eye-slash"></i>
                    </div>

                    <!-- displaying errors -->
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- buttons -->
                <div class="mt-3">
                    @if (Route::has('password.request'))
                    <a class="btn btn-link" id="forgotPSW" href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié ?') }}
                    </a>
                    @endif
                    <div class="button mt-2 " style="float: right;">
                        <button type="submit" class="btn btn-secondary">Confirmer</button>
                    </div>



                </div>

            </form>
        </div>
    </div>
</div>



@endsection