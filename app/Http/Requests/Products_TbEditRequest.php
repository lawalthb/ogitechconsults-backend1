<?php
namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class Products_TbEditRequest extends FormRequest
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
            
				"product_name" => "filled|string",
				"unit" => "nullable|string",
				"description" => "filled",
				"image" => "filled",
				"vendor_id" => "filled",
				"department_id" => "filled",
				"level" => "nullable|string",
				"sell_rate" => "filled|numeric",
				"purchase_rate" => "filled|numeric",
				"status" => "filled|numeric",
				"available_for" => "filled|string",
				"admin_id" => "filled|numeric",
				"vendor_email" => "nullable|email",
				"qty" => "filled|numeric",
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
