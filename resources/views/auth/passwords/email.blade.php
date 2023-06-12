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
    <div class="reset-email-card position-absolute bottom-0">
        <div class="card border-0">
            <div class="card-header bg-light">
                {{ __('Rénitialiser mot de passe') }}
                <a href="{{route('login')}}" type="button" class="btn btn-close btn-sm" aria-label="Close"></a>
            </div>
            <div class="card-body">

                <div class="text-center">
                    <h3><i class="fa fa-lock fa-4x"></i></h3>
                    <h2 class="text-center">Mot de passe oublié?</h2>
                    <p>Vous pouvez le réinitialiser ici.</p>
                </div>

                <!-- message -->
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- formulaire -->
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="row mb-4 px-3">
                        <div class="input-group">
                            <span class="input-group-text custom-form-control" id="basic-addon1">
                                <i class="d-inline medium material-icons">person</i>
                            </span>
                            <input id="email" type="email"
                                class="form-control custom-form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" placeholder="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- button -->
                    <div class="row mb-2 px-4">
                        <button type="submit" class="btn btn-light rounded-pill fw-bold">
                            {{ __('Envoyer lien de rénitialisation') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection
