<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CMT extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_cmt',
        'libelle_cmt',
    ];

    //one to many relationship : one cmt has many consultations, and one consultation belongs to one cmt
    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }
}
