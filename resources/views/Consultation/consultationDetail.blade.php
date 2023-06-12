@extends('layouts.app')
@include('partials.nav')

<style>

</style>

@section('content')

<div class="card consultation-card mx-auto my-5">
    <div class="card-header">
        Détails consultation
        <a href="{{route('consultations.index')}}" type="button" class="btn btn-close btn-sm" aria-label="Close"></a>
    </div>
    <div class="card-body">

        <p id="date" colspan="2">{{date('d M Y', strtotime($consultation->date_consultation)) }}</p>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="fw-bold td-header" colspan="2">Diagnostic et modalités de prise en charge</td>
                </tr>
                <tr>
                    <td>
                        @if($consultation->symptomes == 'O')
                        Sujet symptomatique
                        @else
                        Sujet asymptomatique
                        @endif
                    </td>
                    <td>
                        @if($consultation->maladies_chroniques == 'O')
                        maladies chroniques
                        @else
                        Pas de maladies chroniques
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        Test {{ $consultation->depistage()->first()->type_test }}
                        {{ $consultation->depistage()->first()->resultat_test }}
                    </td>
                    <td>
                        @switch($consultation->modalités_priseEnCharge)

                        @case('D')
                        Confinement domicile
                        @break

                        @case('RT')
                        Reprise de travail
                        @break

                        @case('BDV')
                        Confinement Base de vie
                        @break

                        @case('H')
                        Hospitalisation
                        @break

                        @endswitch
                    </td>
                </tr>
                @if($consultation->modalités_priseEnCharge == 'BDV')
                <tr>
                    <td>
                        Période de confinement : {{$consultation->periode_confinement}} jours
                    </td>
                    <td>
                        Zone de confinement : {{ $consultation->zone()->first()->libelle_zone }}
                    </td>
                </tr>
                @else
                <tr>
                    <td colspan="2">
                        Période de confinement : {{$consultation->periode_confinement}} jours
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>

                <tr>
                    <td colspan="2">
                        <div>
                            <b>Evolution de la maladie : </b>
                            @if($consultation->evolution_maladie)

                            @switch($consultation->evolution_maladie)

                            @case('D')
                            Décès
                            @break

                            @case('P')
                            Prolongation du confinement
                            @break

                            @case('G')
                            Guérison
                            @break

                            @endswitch

                            @else
                            ___
                            @endif
                        </div>
                        <div>
                            <b>Observation : </b>
                            @if($consultation->observation)
                            {{$consultation->observation}}
                            @else
                            ___
                            @endif
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


@endsection