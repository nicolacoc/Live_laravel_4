<?php

namespace App\Http\Requests;

use App\Models\Actor;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class Actor_ins_upd_Request extends FormRequest
{

    private $actor;

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
            Actor::First_name_name => ['required', 'string', 'max:255'],
            Actor::Last_name_name => ['required', 'string', 'max:255']
        ];
    }

    public function messages()
    {
        return [
            Actor::First_name_name . '.required' => 'The :attribute field is required.',
            Actor::First_name_name . '.string' => 'The :attribute field must be a string.',
            Actor::First_name_name . '.max' => 'The :attribute field must not exceed :max characters.',
            Actor::Last_name_name . '.required' => 'The :attribute field is required.',
            Actor::Last_name_name . '.string' => 'The :attribute field must be a string.',
            Actor::Last_name_name . '.max' => 'The :attribute field must not exceed :max characters.',
        ];
    }

    protected function prepareForValidation()
    {
        $this->actor = $this->request->all();
    }

    protected function failedValidation(Validator $validator)
    {
        $validator->validate();

        if ($validator->errors()->isNotEmpty())
            redirect()
                ->back()
                ->withInput($this->actor)
                ->withErrors($validator->errors());

    }
}
