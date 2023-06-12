@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #fff;
    }
</style>

<div id="upper-verify-div">
    <div class="h-100">
        <div class="d-flex flex-column align-items-center text-center ">
            <img class="rounded-circle profile-picture mt-4 mb-3 bg-light" src="/images/user.jpg">
            <span class="fw-bold">Compte Créé</span>
        </div>
    </div>
</div>

<div class="card border-0 text-center">
    <div class="card-body text-secondary">
        @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse e-mail.') }}
        </div>
        @endif

        <p>{{ __('Votre compte a été créé avec succès, merci d\'avoir commencé avec notre portail employé de COVID-19!') }}</p>
        <p> {{ __('Nous avons besoin d\'un peu plus d\'informations pour compléter votre inscription, 
                y compris une confirmation de votre adresse e-mail, veuillez vérifier votre courrier de la boîte de réception.') }}
        </p>
        <p class="fw-bold">{{ __('Si vous n\'avez rien reçu') }},</p>

        <form class="d-inline mb-2  " method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" id="verify-link" class="btn btn-link p-0 m-0 align-baseline text-decoration-none fw-bold">
                Cliquez ici pour recevoir un nouveau lien.
            </button>
        </form>
    </div>
</div>
@endsection