<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:products',
            'code' => 'required|unique:products',
            'slug' => 'unique:products',
            'description' => 'required',
            'images' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
            'sub_category_id' => '',
        ];
    }
}
