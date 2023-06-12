@extends('layouts.app')
@include('partials.nav')

@section('content')
<!-- <meta http-equiv="refresh" content="5"> -->
<style>
    body {
        background-color: white;
    }
</style>



<div class="container container-fluid dashboard-container mx-auto my-4">

    <h3>
        Tableau de bord <i class="fa-solid fa-chart-pie"></i>
    </h3>
    
    <div class="cards">
        <div class="row">

            <div class="col-6 pright">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><b>Cas Positifs</b></h5>
                        <p class="card-text text-grayy">
                            Total : {{$cas_positifs_total}} <br>
                            Actifs : {{$cas_positif_actives}}
                        </p>
                    </div>

                </div>
            </div>

            <div class="col-6 pleft">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><b>Vaccination</b></h5>
                        <p class="card-text col text-grayy">
                            Total : {{$vaccination_total}} <br>
                            Pct : {{$vaccination_pourcentage}}%
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-6 pright">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><b>Hospitalisés</b></h5>
                        <p class="card-text text-grayy">
                            Total : {{$cas_hospitalisés_total}} <br>
                            Actifs : {{$cas_hospitalisés_actives}}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-6 pleft">
                <div class="card mb-3 py-2 px-0">
                    <div class="card-body deces-gueris-card">
                        <div class="row pb-2">
                            <h5 class="col-6"><b>Décés</b></h5>
                            <h5 class="col-6"><b>Guéris</b></h5>
                        </div>
                        <div class="row">
                            <div class="col-6 text-grayy">Total : {{$deces}}</div>
                            <div class="col-6 text-grayy">Total : {{$cas_guéris}}</div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body pb-2">
            <div class="text-center mt-1 mb-3">
                <h6 class="text-grayy"><strong>Situation COVID-19 Division Production</strong></h6>
            </div>
            <div class="chart-height" class="mt-0">
                {!! $covid_chart->container() !!}
                {!! $covid_chart->script() !!}
            </div>
        </div>
    </div>

    <div class="card px-0 py-0 mb-3">
        <div class="card-body pb-3 px-0 chart">
            <div class="text-center mt-1">
                <h6 class="text-grayy"><strong>Situation Vaccination</strong></h6>
            </div>
            <div class="chart-height">
                {!! $vaccination_chart->container() !!}
                {!! $vaccination_chart->script() !!}
            </div>
        </div>
    </div>

    <div class="card px-0 py-0 mb-3">
        <div class="card-body pb-3 px-0 chart">
            <div class="text-center mt-1 mb-0">
                <h6 class="text-grayy"><strong>Situation Dépistage</strong></h6>
            </div>
            <div class="mt-0 chart-height">
                {!! $covid_test_chart->container() !!}
                {!! $covid_test_chart->script() !!}
            </div>
        </div>
    </div>


</div>


@endsection