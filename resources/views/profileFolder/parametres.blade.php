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

<div class="card editProfileCard mx-auto mt-5">
    <div class="card-header">
        Modifier les paramètres du compte
        <a href="{{ route('profile.index') }}" type="button" class="btn btn-close btn-sm" aria-label="Close"></a>
    </div>
    <div class="card-body editProfileForm">
        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
        @endif
        <div class="form">
            <form action="{{ route('parametres.update', ['parametre'=>$user->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="patch">

                <!-- change profile picture -->
                <div class="change-pic d-flex flex-column align-items-center text-center mb-3">
                    <input type="image" id="output" class="rounded-circle profile-picture" src="{{ $user->profile_image }}">

                    <label class="fw-bold mt-2" for="image">
                        Changer photo de profile
                        <input id="image" type="file" name="image" accept="image/*" value="{{ $user->profile_image }}" onchange="loadFile(event)" hidden />
                    </label>
                </div>

                <!-- change other columns -->
                <div class="input-field">
                    <i class="fa-solid fa-id-badge"></i>
                    <input type="text" name="matricule" value="{{ $user->matricule }}" disabled>
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="nom" value="{{ $user->nom }}">

                    <!-- displaying errors -->
                    @if ($errors->any('nom'))
                    <span class="text-danger">{{ $errors->first('nom')  }}</span>
                    @endif
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="prenom" value="{{ $user->prenom }}">

                    <!-- displaying errors -->
                    @if ($errors->any('prenom'))
                    <span class="text-danger">{{ $errors->first('prenom')  }}</span>
                    @endif
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="email" value="{{ $user->email }}">

                    <!-- displaying errors -->
                    @if ($errors->any('email'))
                    <span class="text-danger">{{ $errors->first('email')  }}</span>
                    @endif
                </div>
                <div class="button text-center">
                    <input class="btn text-light rounded fw-bold mt-5" type="submit" value="Enregistrer">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- change password -->
<div class="fw-bold text-center mt-4 mb-5">
    <a href="{{ route('parametres.edit', ['parametre'=>$user->id]) }}" class="change-psw text-decoration-none">
        Changer mot de passe
    </a>
</div>


@endsection
