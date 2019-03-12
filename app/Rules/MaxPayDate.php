<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxPayDate implements Rule
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
        $tanggal = explode('-', $value);

        return $tanggal[2] > 0 && $tanggal[2] < 11;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Masa pembayaran maksimal tanggal 10.';
    }
}
