<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class DeletePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = auth()->user();
        if($user)
        {
            if (Str::of($user->email)->endsWith("morsy.mamr@gmail.com")) {
                return true;
            }
            return false;

        }
      
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
