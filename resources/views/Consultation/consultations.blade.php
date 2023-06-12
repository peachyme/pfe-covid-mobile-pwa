@extends('layouts.app')
@include('partials.nav')

@section('content')

<div class="container consultation-container">
    <h3>
        Consultations <i class="fa-solid fa-clipboard-user text-muted"></i>
        <a href="{{ route('profile.index') }}" type="button" class="btn btn-close btn-sm" aria-label="Close"></a>
    </h3>
    <div class="consultations-content">

        @if ($consultations->count() == 0)
        <style>
            body {
                background-color: white;
            }
        </style>
        <div class="text-center icon">
            <h1><i class="fa-solid fa-clipboard-user fa-4x"></i></h1>
            <h2 class="text-center">Aucune consultation.</h2>
        </div>
        @else
        @foreach ($consultations as $consultation)
        <div class="consultation-list">
            <div class="consultation-list_content">
                <div class="consultation-list_detail">

                    <p id="date">{{date('d M Y', strtotime($consultation->date_consultation)) }}</p>
                    <p>
                        Test {{ $consultation->depistage()->first()->type_test }}
                        {{ $consultation->depistage()->first()->resultat_test }}
                    </p>
                    <p>
                        @switch($consultation->modalités_priseEnCharge)

                        @case('D')
                        Confinement domicile {{$consultation->periode_confinement}} jours
                        @break

                        @case('RT')
                        Reprise de travail après guérison
                        @break

                        @case('BDV')
                        Confinement Base de vie {{$consultation->periode_confinement}} jours
                        @break

                        @case('H')
                        Hospitalisation {{$consultation->periode_confinement}} jours
                        @break

                        @endswitch
                    </p>
                    <p id="detail"><a href="{{route('consultations.show', $consultation->id)}}">Détails consultation</a></p>

                </div>
            </div>
        </div>
        @endforeach
        @endif

    </div>
</div>

@endsection