<?php
namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
class Users_TbEditRequest extends FormRequest
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
		
		$rec_id = request()->route('rec_id');

        return [
            
				"firstname" => "filled|string|unique:users_tb,firstname,$rec_id,user_id",
				"lastname" => "filled|string",
				"matric_no" => "nullable|string",
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
				"email_verified_at" => "nullable|date",
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
