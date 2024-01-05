<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetUpdateRequest extends FormRequest
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
            'id' => ['required', 'numeric'],
            'name' => ['required', 'max:100'],
            'status' => ['required', 'in:available,pending,sold'],
            'tags' => ['required', 'array'],
            'tags.*.id' => ['required', 'numeric'],
            'tags.*.name' => ['required', 'max:100'],
            'category_id' => ['required', 'numeric'],
            'category_name' => ['required'],
            'photo_urls' => ['required', 'array']
        ];
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array<string, mixed>
     */
    public function validationData(): array
    {
        return [
            'id' => $this->input('id'),
            'name' => $this->input('name'),
            'status' => $this->input('status'),
            'tags' => $this->input('tags'),
            'category_id' => $this->input('categoryId'),
            'category_name' => $this->input('categoryName'),
            'photo_urls' => $this->input('photoUrls'),
        ];
    }
}
