<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:20',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'categories' => 'nullable|array|exists:categories,id'
        ];
        if (request()->method('PUT')) {
            $rules['image'] = 'nullable|image|mimes:png,jpg,jpeg|max:2048';
        }
        return $rules;
    }
    public function messages()
    {
        $messages = [
            'title.required' => 'Title is Required :)'
        ];
        return $messages;
    }
}
