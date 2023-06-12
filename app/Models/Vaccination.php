<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    use HasFactory;

    protected $guarded = [];

    //one to many relationship : one employe has many vaccinations, and one vaccination belongs to one employe
    public function employeOrganique()
    {
        return $this->belongsTo(EmployeOrganique::class, 'organique_id', 'id');
    }

    //one to many relationship : one sousTraitant has many vaccinations, and one vaccination belongs to one sousTraitant
    public function sousTraitant()
    {
        return $this->belongsTo(SousTraitant::class, 'sousTraitant_id');
    }
}
