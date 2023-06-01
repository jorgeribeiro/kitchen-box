<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBoxRequest extends FormRequest
{
    private const MIN_DELIVERY_PERIOD = '48 hours';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $mininumDeliveryDate = date(DATE_ATOM, strtotime(self::MIN_DELIVERY_PERIOD));

        return [
            'delivery_date' => "required|date|after:$mininumDeliveryDate",
            'recipe_ids' => 'required|array|max:4',
            'recipe_ids.*' => 'exists:recipes,id',
        ];
    }
}
