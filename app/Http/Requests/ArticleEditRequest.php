<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ArticleEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user() == null) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'image' => 'file|mimes:jpeg,png|max:2048',
            'active' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'image.file' => 'The image must be file.',
            'image.mimes:jpeg,png' => 'The image must be type of jpeg or png.',
            'image.max' => 'The image must be maximum 2048 kbs.',
            'active.required' => 'The status is required.',
        ];
    }
}
