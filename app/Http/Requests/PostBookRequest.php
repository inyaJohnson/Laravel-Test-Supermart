<?php

namespace App\Http\Requests;

use App\Author;
use App\Book;
use Illuminate\Foundation\Http\FormRequest;

class PostBookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
         // @TODO implement
        return[
            'isbn' => 'required|digits:13|unique:books',
            'title' => 'required|string',
            'description' => 'required|string',
            'authors' => 'required|array',
            'authors.*' => 'integer'
        ];
    }
}
