<?php

namespace App\Rules;

use App\Models\Follower;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class NoIdenticalFollow implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        if(Follower::where('follower_id', Auth::id())->where('user_id', $value)->exists()){
            $fail('Invalid follow, the pair already exists');
        }

        else if($value === Auth::id()){
            $fail('Invalid follow. You cannot follow yourself');
        }
    }
}
