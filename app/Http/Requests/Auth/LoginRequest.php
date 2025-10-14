<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $userAuthenticated = Auth::attempt([
                'email' => $this->email,
                'password' => $this->password
            ]);

            if(! $userAuthenticated){
                $validator->errors()->add('login', 'Credenciais inválidas');
            }
        });
    }
}

