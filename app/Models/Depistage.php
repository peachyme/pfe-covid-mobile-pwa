<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depistage extends Model
{
    use HasFactory;

    protected $guarded = [];

    //one to one relationship : one depistage has one consultation, and one consultation belongs to one depistage
    public function consultation()
    {
        return $this->hasOne(Consultation::class,);
    }
}
