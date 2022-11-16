<?php

namespace App\Actions\Fortify;

use App\Models\City;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'city_id' => ['required','exists:cities,id'],
            'birth' => ['required', 'date'],
            'gender' => ['required', 'min:1', 'max:2', 'integer'],
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'lastname' => $input['lastname'],
            'city_id' => $input['city_id'],
            'birth' => $input['birth'],
            'gender' => $input['gender'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
