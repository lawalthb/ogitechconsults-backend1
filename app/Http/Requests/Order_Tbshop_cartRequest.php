<?php
namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class Order_Tbshop_cartRequest extends FormRequest
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
            
				"order_no" => "nullable|unique:order_tb,order_no",
				"product_id" => "required",
				"vendor_id" => "required",
				"user_id" => "nullable",
				"mat_no" => "nullable",
				"rate" => "required|string",
				"qty" => "required|numeric|max:20|min:1",
				"total_amount" => "required|numeric",
				"payment_optn" => "nullable",
				"date" => "nullable",
				"order_status" => "required",
				"sales_status" => "required",
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
