<?php

namespace App\Rules;

use App\Models\EmployeOrganique;
use App\Models\SousTraitant;
use Illuminate\Contracts\Validation\Rule;

class matriculeExists implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (SousTraitant::where('matricule', '=', $value)->count() != 0 || EmployeOrganique::where('matricule', '=', $value)->count() != 0);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Matricule incorrect';
    }
}
