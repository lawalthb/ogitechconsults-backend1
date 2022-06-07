<?php
namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class Products_TbAddRequest extends FormRequest
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
            
				"product_name" => "required|string",
				"unit" => "nullable|string",
				"description" => "required",
				"image" => "required",
				"vendor_id" => "required",
				"department_id" => "required",
				"level" => "nullable|string",
				"sell_rate" => "required|numeric",
				"purchase_rate" => "required|numeric",
				"status" => "required|numeric",
				"available_for" => "required|string",
				"admin_id" => "required|numeric",
				"vendor_email" => "nullable|email",
				"qty" => "required|numeric",
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
