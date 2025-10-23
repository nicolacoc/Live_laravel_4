<?php

namespace App\Http\Requests;

use App\Models\Film;
use App\Rules\Uppercase;
use Illuminate\Foundation\Http\FormRequest;

class Film_ins_upd_Request extends FormRequest
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
            Film::Title_name => ['required','string','max:255', new Uppercase],
            Film::Description_name => ['required','string'],
            Film::Language_id_name => ['integer'],
            Film::Original_language_id_name => ['integer'],
            Film::Release_year_name => ['integer', 'date_format:Y'],
            Film::Replacement_cost_name => ['required', 'numeric', 'max:19'],
            Film::Rental_duration_name => ['required', 'integer'],
            Film::Rental_rate_name => ['required', 'numeric', 'max:4.80']
        ];
    }

    public function messages()
    {
        return [
            Film::Title_name.'.required' => 'The :attribute field is required.',
            Film::Title_name.'.string' => 'The :attribute field must be a string.',
            Film::Title_name.'.max' => 'The :attribute field must not exceed :max characters.',
            Film::Title_name.'.uppercase' => 'The :attribute field must be uppercase.',
          Film::Description_name.'.required' => 'The :attribute field is required.',
            Film::Description_name.'.string' => 'The :attribute field must be a string.',
          Film::Language_id_name.'.integer' => 'The :attribute field must be an integer.',
            Film::Original_language_id_name.'.integer' => 'The :attribute field must be an integer.',
            Film::Release_year_name.'.integer' => 'The :attribute field must be an integer.',
            Film::Release_year_name.'.date_format' => 'The :attribute field must be in the format YYYY.',
            Film::Replacement_cost_name.'.required' => 'The :attribute field is required.',
            Film::Replacement_cost_name.'.numeric' => 'The :attribute field must be a number.',
            Film::Replacement_cost_name.'.max' => 'The :attribute field must not exceed :max.',
            Film::Rental_duration_name.'.required' => 'The :attribute field is required.',
            Film::Rental_duration_name.'.integer' => 'The :attribute field must be an integer.',
            Film::Rental_rate_name.'.required' => 'The :attribute field is required.',
            Film::Rental_rate_name.'.numeric' => 'The :attribute field must be a number.',
            Film::Rental_rate_name.'.max' => 'The :attribute field must not exceed :max.',
        ];
    }
}
