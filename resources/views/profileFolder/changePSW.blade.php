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
        Modifier mot de passe
        <a href="{{ route('parametres.index') }}" type="button" class="btn btn-close btn-sm" aria-label="Close"></a>
    </div>
    <div class="card-body">
        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
        @endif
        @if (session('fail'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('fail') }}
        </div>
        @endif
        <div class="form">
            <form action="{{ route('update_password') }}" method="post">
                @csrf
                <div class="input-field">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="old_password" class="input" id="old_password" placeholder="Mot de passe actuel">
                    <div class="eye" onclick="showHideOld()">
                        <i id="hideOld" class="fa-regular fa-eye"></i>
                        <i id="showOld" class="fa-regular fa-eye-slash"></i>
                    </div>

                    <!-- displaying errors -->
                    @if ($errors->any('old_password'))
                    <span class="text-danger">{{ $errors->first('old_password')  }}</span>
                    @endif
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="new_password" class="input" id="new_password" placeholder="Nouveau mot de passe">
                    <div class="eye" onclick="showHideNew()">
                        <i id="hideNew" class="fa-regular fa-eye"></i>
                        <i id="showNew" class="fa-regular fa-eye-slash"></i>
                    </div>

                    <!-- displaying errors -->
                    @if ($errors->any('new_password'))
                    <span class="text-danger">{{ $errors->first('new_password')  }}</span>
                    @endif
                </div>
                <div class="input-field">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirmer mot de passe">
                    <div class="eye" onclick="showHideConfirm()">
                        <i id="hideConfirm" class="fa-regular fa-eye"></i>
                        <i id="showConfirm" class="fa-regular fa-eye-slash"></i>
                    </div>

                    <!-- displaying errors -->
                    @if ($errors->any('confirm_password'))
                    <span class="text-danger">{{ $errors->first('confirm_password')  }}</span>
                    @endif
                </div>

                <!-- buttons -->
                <div class="button text-center mt-5">
                    <button type="submit" class="btn btn-secondary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection