@extends('layouts.app')
@include('partials.nav')

@section('content')
<style>
    body {
        background-color: #fff;
    }
</style>
<div class="container mt-4">
    <div class="d-flex flex-column align-items-center text-center">
        <img class="rounded-circle profile-picture" src="{{ $user->profile_image }}">
        <span class="fw-bold name">{{ ucfirst($user->nom) }} {{ ucfirst($user->prenom) }}</span><span class="text-black-50">{{ $user->email }}</span>
    </div>
</div>

<div class="container mt-3">
    <ul class="nav nav-pills flex-column mb-auto align-items-center">
        <li class="nav-item profile-item border-bottom">
            <a href="{{route('consultations.index')}}" class="nav-link link-dark">
                <i class="fa-solid fa-hospital-user"></i>
                Consultation
            </a>
        </li>
        <li class="nav-item profile-item border-bottom">

            <a href="{{ route('vaccination.index') }}" class="nav-link link-dark">
                <i class="fa-solid fa-syringe "></i>
                Vaccination
            </a>
        </li>
        <li class="nav-item profile-item border-bottom">
            <a href="{{ route('password.confirm') }}" class="nav-link link-dark">
                <i class="fa-solid fa-gears"></i>
                Paramètres du compte
            </a>
        </li>
        <li class="nav-item profile-item border-bottom">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="nav-link link-dark">
                <i class="fa-solid fa-right-from-bracket"></i>
                Déconnecter
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</div>

@endsection