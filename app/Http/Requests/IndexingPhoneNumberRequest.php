<?php

namespace App\Http\Requests;

use App\Enums\PhoneValidationStatesEnum;
use App\PhoneRegex\PhoneRegexFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexingPhoneNumberRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'country_code' => ['nullable', Rule::in(PhoneRegexFactory::getCountriesCode())],
            'state' => ['nullable', Rule::in(PhoneValidationStatesEnum::ALL_STATES)],
        ];
    }
}
