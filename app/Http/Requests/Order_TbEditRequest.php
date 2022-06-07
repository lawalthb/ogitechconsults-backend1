<?php
namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class Order_TbEditRequest extends FormRequest
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
				"product_id" => "filled",
				"vendor_id" => "filled",
				"user_id" => "filled|string",
				"mat_no" => "nullable|string",
				"rate" => "filled|numeric",
				"qty" => "filled|numeric|max:20|min:1",
				"total_amount" => "filled|numeric",
				"payment_optn" => "nullable|string",
				"date" => "filled|date",
				"order_status" => "filled|numeric",
				"sales_status" => "filled|numeric",
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
