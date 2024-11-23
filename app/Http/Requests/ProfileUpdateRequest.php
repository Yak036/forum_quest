<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {

        return [
                'name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'id_number' => ['required', 'string', 'max:20'],
                'nationality' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
                'date_of_birth' => ['required', 'date'],

                'facebook' => ['nullable', 'url', 'regex:/^https:\/\/(www|es-la)\.facebook\.com\/.+$/'],
                'instagram' => ['nullable', 'url', 'regex:/^https:\/\/www\.instagram\.com\/.+$/'],
                'twitter' => ['nullable', 'url', 'regex:/^https:\/\/www\.x\.com\/.+$/'],
                'tiktok' => ['nullable', 'url', 'regex:/^https:\/\/www\.tiktok\.com\/.+$/'],
                'personal_page' => ['nullable', 'url', 'regex:/^https:\/\/.+$/'],
                'description' => ['nullable', 'string', 'max:1000'],
            ];

    }
}
