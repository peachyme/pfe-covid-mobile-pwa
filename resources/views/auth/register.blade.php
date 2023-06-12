@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('/images/bg2.png');
    }
</style>
<div class="col-3 col-sm-3 col-md-3 mx-auto  text-center" style="margin-top: 85px;">
    <img src="/images/logoo.png" alt="wtv" class="img-fluid" >
</div>
<div class="position-absolute register-card bottom-0 ">
    <div class="card border-0 h-100">
        <div class="card-header bg-light">
            {{ __('Créer compte') }}
            <a href="{{route('login')}}" type="button" class="btn btn-close btn-sm" aria-label="Close"></a>
        </div>

        <div class="card-body">
            @if (session('fail'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('fail') }}
            </div>
            @endif
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="row mb-4 px-3">
                    <div class="input-group">
                        <span class="input-group-text custom-form-control" id="basic-addon1">
                            <i class="d-inline medium material-icons">person</i>
                        </span>
                        <input id="matricule" type="text" class="form-control custom-form-control @error('matricule') is-invalid @enderror" name="matricule" value="{{ old('matricule') }}" required autocomplete="matricule" placeholder="matricule d'utilisateur" autofocus>

                        @error('matricule')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4 px-3">
                    <div class="input-group">
                        <span class="input-group-text custom-form-control" id="basic-addon1">
                            <i class="d-inline medium material-icons">person</i>
                        </span>
                        <input id="nom" type="text" class="form-control custom-form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" required autocomplete="nom" placeholder="nom d'utilisateur" autofocus>

                        @error('nom')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4 px-3">
                    <div class="input-group">
                        <span class="input-group-text custom-form-control" id="basic-addon1">
                            <i class="d-inline medium material-icons">person</i>
                        </span>
                        <input id="prenom" type="text" class="form-control custom-form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ old('prenom') }}" required autocomplete="prenom" placeholder="prenom d'utilisateur" autofocus>

                        @error('prenom')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4 px-3">
                    <div class="input-group">
                        <span class="input-group-text custom-form-control" id="basic-addon1">
                            <i class="d-inline medium material-icons">email</i>
                        </span>
                        <input id="email" type="email" class="form-control custom-form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="email" autocomplete="email">

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
                        <input id="password" type="password" class="form-control custom-form-control @error('password') is-invalid @enderror" name="password" required placeholder="mot de passe" autocomplete="new-password">

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
                        <input id="password-confirm" type="password" class="form-control custom-form-control" name="password_confirmation" required placeholder="confirmer mot de passe" autocomplete="new-password">
                    </div>
                </div>

                <div class="row mb-2 px-4">
                    <button type="submit" class="btn btn-light rounded-pill fw-bold">
                        {{ __('Créer') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection