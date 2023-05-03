<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ArticleRequest extends FormRequest
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
            'title' => 'required',
            'intro' => 'required',
            'content' => 'required',
            'image' => 'file|mimes:jpeg,png|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title is required.',
            'intro.required' => 'The intro is required.',
            'content.required' => 'The content is required.',
            'image.file' => 'The image must be file.',
            'image.mimes:jpeg,png' => 'The image must be type of jpeg or png.',
            'image.max' => 'The image must be maximum 2048 kbs.'
        ];
    }
}
