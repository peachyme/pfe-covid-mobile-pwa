<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Reunion;
use App\Models\Depistage;
use App\Charts\CovidChart;
use App\Models\Vaccination;
use App\Models\Consultation;
use App\Models\SousTraitant;
use Illuminate\Http\Request;
use App\Charts\CovidTestChart;
use App\Models\EmployeOrganique;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Charts\VaccinationDoughnutChart;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           
        $consultations = Consultation::all();

        $nb_employes = EmployeOrganique::count() + SousTraitant::count();


        // cas positifs total :
        $cas_positifs_total = Consultation::join('depistages', 'depistages.id', '=', 'consultations.depistage_id')
            ->where('resultat_test', 'Positif')
            ->count() -
            Consultation::join('depistages', 'depistages.id', '=', 'consultations.depistage_id')
            ->where('resultat_test', 'Positif')
            ->where('evolution_maladie', 'P')
            ->count() -
            Consultation::join('depistages', 'depistages.id', '=', 'consultations.depistage_id')
            ->where('resultat_test', 'Positif')
            ->where('evolution_maladie', 'D')
            ->count();

        // cas potifis actives last consultation where modalite != RT && evolution = null
        $cas_positif_actives = EmployeOrganique::whereHas('latest_consultation', function ($query) {
            $query->whereNull('evolution_maladie')->where('modalités_priseEnCharge', '<>', 'RT');
        })->count() +
            SousTraitant::whereHas('latest_consultation', function ($query) {
                $query->whereNull('evolution_maladie')->where('modalités_priseEnCharge', '<>', 'RT');
            })->count();

        // cas hospitalisés total :
        $cas_hospitalisés_total = Consultation::where('modalités_priseEnCharge', 'H')->count();

        // cas hospitalisés actives last consultation where modalite = H
        $cas_hospitalisés_actives = EmployeOrganique::whereHas('latest_consultation', function ($query) {
            $query->where('modalités_priseEnCharge', 'H');
        })->count() +
            SousTraitant::whereHas('latest_consultation', function ($query) {
                $query->where('modalités_priseEnCharge', 'H');
            })->count();

        // cas guéris 
        $cas_guéris = Consultation::where('evolution_maladie', 'G')->count();

        // deces
        $deces = Consultation::where('evolution_maladie', 'D')->count();


        // vaccination total :
        $vaccination_total = Vaccination::where('dose_vaccination', 1)->count();

        // vaccination %
        $vaccination_pourcentage = round((($vaccination_total * 100) / $nb_employes), 2);


        // covid line chart
        $covid_chart = new CovidChart();
        $start = Carbon::parse('01-03-2020')->format('Y-m-d');
        $end = Carbon::now()->format('Y-m-d');
        $covid_chart_data = [];
        $covid_data = Consultation::join('depistages', 'depistages.id', '=', 'consultations.depistage_id')
            ->select([DB::raw("DATE_FORMAT(date_consultation, '%Y-%m') as month"), DB::raw('COUNT(consultations.id) as cas_positifs')])
            ->whereBetween('date_consultation', [$start, $end])
            ->where('depistages.resultat_test', 'Positif')
            ->groupBy('month')
            ->get();

        $covid_data->each(function ($item) use (&$covid_chart_data) {
            $covid_chart_data[$item->month] = [
                'cas_positifs' => $item->cas_positifs,
            ];
        });

        $start_year = Carbon::parse('01-02-2020');
        $end_year = Carbon::now()->subMonth();

        $months = [];
        while ($start_year < $end_year) {
            $months[] = $start_year->addMonth()->format('Y-m');
        }
        $labels = $months;
        $data = [];
        foreach ($months as $month) {
            $data[] = $covid_chart_data[$month]['cas_positifs'] ?? '0';
        }

        $covid_chart->labels($labels);
        $covid_chart->dataset('Cas confirmés positifs', 'line', $data);


        //COVID TEST DOUGHNUT CHART
        $nb_tests = Depistage::count();
        $covid_test_chart_data_positif = (Depistage::where('resultat_test', 'Positif')->count() * 100) / $nb_tests;
        $covid_test_chart_data_negatif = (Depistage::where('resultat_test', 'Négatif')->count() * 100) / $nb_tests;
        $covid_test_chart_labels = ['Tests positifs', 'Tests négatifs'];
        $covid_test_chart_data = [$covid_test_chart_data_positif, $covid_test_chart_data_negatif];

        $covid_test_chart = new CovidTestChart();
        $covid_test_chart->labels($covid_test_chart_labels);
        $covid_test_chart->dataset('Tests', 'doughnut', $covid_test_chart_data)->options(['backgroundColor' => ['#a6a6a6', '#F9C18C']]);
        $covid_test_chart->minimalist(true);
        $covid_test_chart->displayLegend(true);
        $covid_test_chart->options([
            'legend' => [
                'position' => 'bottom',
            ],

        ]);


        //VACCINATION DOUGHNUT CHART
        $organiques_vacc = round((Vaccination::whereNotNull('organique_id')->count() * 100) / $nb_employes, 2);
        $sousTraitans_vacc = round((Vaccination::whereNotNull('sousTraitant_id')->count() * 100) / $nb_employes, 2);
        $non_vacc = round((($nb_employes - $vaccination_total) * 100) / $nb_employes, 2);
        $vaccination_chart_labels = ['Organique SH vaccinés', 'Sous-Traitants vaccinés', 'Non Vaccinés'];
        $vaccination_chart_data = [$organiques_vacc, $sousTraitans_vacc, $non_vacc];

        $vaccination_chart = new VaccinationDoughnutChart();
        $vaccination_chart->labels($vaccination_chart_labels);
        $vaccination_chart->dataset('Tests', 'doughnut', $vaccination_chart_data)->options(['backgroundColor' => ['#a6a6a6', '#F9C18C']]);
        $vaccination_chart->minimalist(true);
        $vaccination_chart->displayLegend(true);
        $vaccination_chart->options([
            'legend' => [
                'position' => 'bottom',
            ],
        ]);

        return view('dashboard', compact(
            'covid_chart',
            'covid_test_chart',
            'vaccination_chart',
            'vaccination_total',
            'vaccination_pourcentage',
            'cas_positifs_total',
            'cas_positif_actives',
            'cas_hospitalisés_total',
            'cas_hospitalisés_actives',
            'cas_guéris',
            'deces',
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
