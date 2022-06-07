<?php
namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class Order_TbAddRequest extends FormRequest
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
            
				"order_no" => "nullable|string",
				"product_id" => "required",
				"vendor_id" => "required",
				"user_id" => "required|string",
				"mat_no" => "nullable|string",
				"rate" => "required|numeric",
				"qty" => "required|numeric|max:20|min:1",
				"total_amount" => "required|numeric",
				"payment_optn" => "nullable|string",
				"date" => "required|date",
				"order_status" => "required|numeric",
				"sales_status" => "required|numeric",
				"remark" => "nullable",
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
