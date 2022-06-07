<?php
namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class Stock_TbAddRequest extends FormRequest
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
            
				"date" => "nullable|date",
				"user_id" => "nullable|numeric",
				"mat_no" => "nullable|string",
				"item_id" => "required",
				"vendor_id" => "required",
				"user_type" => "required|numeric",
				"item_in" => "required|numeric",
				"item_out" => "required|numeric",
				"item_balance" => "required|numeric",
				"payment_id" => "required|numeric",
				"status" => "required|numeric",
        ];
    }

	public function messages()
    {
        return [
            //using laravel default validation messages
        ];
    }

	/**
     * If validator fails return the exception in json form
     * @param Validator $validator
     * @return array
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
