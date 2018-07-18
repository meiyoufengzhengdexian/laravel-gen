<?php
namespace App\Http\Requests;

use App\Exceptions\AdminValidateException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ArticelCreateRequest extends FormRequest
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
                        'id' => 'required|min:10',
                        'cate_id' => 'required|min:10',
                        'title' => 'required|min:10',
                        'content' => 'required|min:10',
                        'desc' => 'required|min:10',
                        'img' => 'required|min:10',
                        'deleted_at' => 'required|min:10',
                        'created_at' => 'required|min:10',
                        'updated_at' => 'required|min:10',
                    ];
    }


    public function messages()
    {
        return [
                                                
                    'id.required' => '此项必须填写',
                                    
                    'id.min' => '最小为10',
                                                                
                    'cate_id.required' => '此项必须填写',
                                    
                    'cate_id.min' => '最小为10',
                                                                
                    'title.required' => '此项必须填写',
                                    
                    'title.min' => '最小为10',
                                                                
                    'content.required' => '此项必须填写',
                                    
                    'content.min' => '最小为10',
                                                                
                    'desc.required' => '此项必须填写',
                                    
                    'desc.min' => '最小为10',
                                                                
                    'img.required' => '此项必须填写',
                                    
                    'img.min' => '最小为10',
                                                                
                    'deleted_at.required' => '此项必须填写',
                                    
                    'deleted_at.min' => '最小为10',
                                                                
                    'created_at.required' => '此项必须填写',
                                    
                    'created_at.min' => '最小为10',
                                                                
                    'updated_at.required' => '此项必须填写',
                                    
                    'updated_at.min' => '最小为10',
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
