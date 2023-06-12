@extends('layouts.app')
@include('partials.nav')


@section('content')
@if($vaccinations->count() >= 1)
<style>
   

    #dose1 .progress-count:after {
        background: orange;
    }

    #dose1 .progress-count:before {
        content: "";
        height: 10px;
        width: 20px;
        border-left: 3px solid #fff;
        border-bottom: 3px solid #fff;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -60%) rotate(-45deg);
        transform-origin: center center;
    }

    #dose1 .progress-count {
        color: transparent;
        /*this is the number */
    }
</style>
@endif
@if($vaccinations->count() >= 2)
<style>
    #dose2 .progress-count:after {
        background: orange;
    }

    #dose2 .progress-count:before {
        content: "";
        height: 10px;
        width: 20px;
        border-left: 3px solid #fff;
        border-bottom: 3px solid #fff;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -60%) rotate(-45deg);
        transform-origin: center center;
    }

    #dose2 .progress-count {
        color: transparent;
        /*this is the number */
    }

    .step-wizard-item+.step-wizard-item:after {
        background: orange;
    }
</style>
@endif


<div class="container container-fluid vaccination-container mt-4">
    <h3>
        Vaccination <i class="fa-solid fa-syringe text-muted"></i>
        <a href="{{ route('profile.index') }}" type="button" class="btn btn-close btn-sm" aria-label="Close"></a>
    </h3>
    <ul class="step-wizard-list mt-3">
        <li class="step-wizard-item" id="dose1">
            <span class="progress-count">1</span>
            <span class="progress-label">Dose 1</span>
        </li>
        <li class="step-wizard-item" id="dose2">
            <span class="progress-count">2</span>
            <span class="progress-label">Dose 2</span>
        </li>
    </ul>


    @if ($vaccinations->count() == 0)
    <style>
        body {
            background-color: white;
        }
    </style>

    <div class="text-center icon">
        <h1><i class="fa-solid fa-syringe fa-4x"></i></h1>
        <h2 class="text-center">Aucune vaccination.</h2>
    </div>

    @else

    <div class="container container-fluid mt-5">

        @foreach ($vaccinations as $vaccination)
        <div class="card vaccination-card mx-auto mb-4">
            <div class="card-header">
                <b>Dose {{$vaccination->dose_vaccination}}</b>
            </div>
            <div class="card-body">
                <p><b>Date :</b> {{$vaccination->date_vaccination}} </p>
                <p><b>Type vaccin :</b> {{$vaccination->type_vaccin}} </p>
                <p>
                    <b>Observation :</b>
                    @if($vaccination->observation)
                    {{$vaccination->observation}}
                    @else <b>___</b>
                    @endif
                </p>
            </div>
        </div>
        @endforeach

    </div>

    @endif
</div>

@endsection