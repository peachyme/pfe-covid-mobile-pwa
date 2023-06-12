@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('/images/bg2.png');
    }
</style>
<!-- logo -->
<div class="col-3 col-sm-2 my-4 mx-auto ">
    <img src="/images/logoo.png" alt="wtv" class="img-fluid">
</div>
<!-- main part -->
<div class="position-absolute reset-card bottom-0">
    <div class="card border-0">
        <div class="card-header bg-light"> {{ __('Rénitialiser mot de passe') }} </div>
        <div class="card-body">

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <!-- formulaire -->
                <div class="row mb-4 px-3">
                    <div class="input-group">
                        <span class="input-group-text custom-form-control" id="basic-addon1">
                            <i class="d-inline medium material-icons">email</i>
                        </span>
                        <input id="email" type="email" class="form-control custom-form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" placeholder="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4 px-3">
                    <div class="input-group">
                        <span class="input-group-text custom-form-control" id="basic-addon1">
                            <i class="d-inline medium material-icons">lock</i>
                        </span>
                        <input id="password" type="password" class="form-control custom-form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="mot de passe">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4 px-3">
                    <div class="input-group">
                        <span class="input-group-text custom-form-control" id="basic-addon1">
                            <i class="d-inline medium material-icons">lock</i>
                        </span>
                        <input id="password-confirm" type="password" class="form-control custom-form-control" name="password_confirmation" required autocomplete="new-password" placeholder="confirmer mot de passe">
                    </div>
                </div>

                <!-- button -->
                <div class="row mb-2 px-4">
                    <button type="submit" class="btn btn-light rounded-pill fw-bold">
                        {{ __('Rénitialiser mot de passe') }}
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection