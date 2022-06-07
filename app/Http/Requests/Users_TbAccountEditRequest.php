<?php
namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class Users_TbAccountEditRequest extends FormRequest
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
            
				"matric_no" => "filled|string",
				"firstname" => "filled|string",
				"lastname" => "filled|string",
				"phone" => "nullable|string",
				"department" => "filled",
				"level" => "nullable|string",
				"status" => "filled|numeric",
				"email_link" => "nullable|email",
				"email_comfirm" => "filled|numeric",
				"email_token" => "nullable|email",
				"gender" => "nullable",
				"deleted" => "filled|numeric",
				"photo" => "nullable",
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
