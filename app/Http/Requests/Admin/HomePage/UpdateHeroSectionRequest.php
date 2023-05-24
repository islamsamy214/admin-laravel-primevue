<?php

namespace App\Http\Requests\Admin\HomePage;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHeroSectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'hero_title' => ['required', 'string', 'min:3', 'max:255'],
            'hero_image' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
            'hero_description' => ['required', 'min:3'],
        ];
    }
}
