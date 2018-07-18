<?php
namespace App\Http\Requests;

use App\Exceptions\AdminValidateException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ArticelUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [

                    ];
    }


    public function messages()
    {
        return [

                                    ];
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('您没有权限进行此操作');
    }


    /**
    * @param  Validator $validator
    * @throws  AdminValidateException
    */
    protected function failedValidation(Validator $validator){
        throw new AdminValidateException($validator->errors());
    }
}
