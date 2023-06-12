<?php

namespace App\Notifications;

use DateTime;
use Carbon\Carbon;
use App\Models\SousTraitant;
use Illuminate\Bus\Queueable;
use App\Models\EmployeOrganique;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CovidCaseNotification extends Notification
{
    use Queueable;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
     public function toArray($notifiable)
    {
        $employe = EmployeOrganique::where('matricule', '=', $this->user->matricule)->first();
        if ($employe) { //employe organique

            $cases = EmployeOrganique::join('Consultations', 'employe_organiques.id', '=', 'Consultations.organique_id')
                ->join('depistages', 'depistages.id', '=', 'Consultations.depistage_id')
                ->where('depistages.resultat_test', '=', 'Positif')
                ->where('Consultations.date_consultation', '=', (new DateTime('today'))->format('Y-m-d'))
                ->get()->count();

            if ($cases > 0) {
                return [
                    'user_id' => $this->user['id'],
                    'mat' => $this->user['matricule'],
                    'nom' => $this->user['nom'],
                    'prenom' => $this->user['prenom'],
                    'type' => 'organique',
                    'cases' => $cases
                ];
            }
        } else {  //employe sous traitant
            $employe = SousTraitant::where('matricule', '=', $this->user->matricule)->first();

            $cases = SousTraitant::join('Consultations', 'Sous_Traitants.id', '=', 'Consultations.sousTraitant_id')
                ->join('depistages', 'depistages.id', '=', 'Consultations.depistage_id')
                ->where('depistages.resultat_test', '=', 'Positif')
                ->where('Consultations.date_consultation', '=', (new DateTime('today'))->format('Y-m-d'))
                ->where('Consultations.region_id', '=', $employe->region_id)
                ->where('Sous_Traitants.type', '=', $employe->type)
                ->get()->count();

            if ($cases > 0) {
                return [
                    'user_id' => $this->user['id'],
                    'mat' => $this->user['matricule'],
                    'nom' => $this->user['nom'],
                    'prenom' => $this->user['prenom'],
                    'type' => 'sousTraitant',
                    'cases' => $cases
                ];
            }
        }
    }
}
