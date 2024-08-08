<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Enfants6A17Scolarise implements Rule
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
       $ageEnfant6A17 = request('ageEnfant6A17'); // Obtenez la valeur de ageEnfant0A5 depuis la requête

        return $value <= $ageEnfant6A17;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Le nombre d\'enfants de 6 à 17 ans scolarisés doit être inférieur ou égal au nombre d\'enfants de 6 à 17 ans du ménage.';
    }
}
