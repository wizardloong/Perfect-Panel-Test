<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ($this->get('method') == 'rates' && $this->method() == 'GET')
            || ($this->get('method') == 'convert' && $this->method() == 'POST');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'method' => 'required|in:rates,convert',
            'currency_from' => 'required_if:method,convert',
            'currency_to' => 'required_if:method,convert',
            'value' => 'required_if:method,convert|min:0.01',
        ];
    }
}
