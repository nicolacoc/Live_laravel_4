<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class Category_ins_upd_Request extends FormRequest
{

    private $category;

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
            Category::Name_name => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            Category::Name_name . '.required' => 'The :attribute field is required.',
            Category::Name_name . '.string' => 'The :attribute field must be a string.',
            Category::Name_name . '.max' => 'The :attribute field must not exceed :max characters.',
        ];
    }

    protected function prepareForValidation()
    {
        $this->category = $this->request->all();
    }

    protected function failedValidation(Validator $validator)
    {
        $validator->validate();

        if ($validator->errors()->isNotEmpty())
            redirect()
                ->back()
                ->withInput($this->category)
                ->withErrors($validator->errors());


    }
}
