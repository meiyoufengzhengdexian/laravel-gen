
namespace App\Http\Requests;

use App\Exceptions\AdminValidateException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class {{ $basicInfo['model_name'] }}CreateRequest extends FormRequest
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
            @foreach($fields as $field)
            '{{$field['name']}}' => '{{implode('|', collect($field['field_rules'])->pluck('rule')->toArray())}}',
            @endforeach
        ];
    }


    public function messages()
    {
        return [
            @foreach($fields as $field)
                @foreach($field['field_rules'] as $rule)
                    {{-- 截取rule :  --}}
                    '{{$field['name']}}.{{substr($rule['rule'], 0, strpos($rule['rule'], ':' ) ? strpos($rule['rule'], ':') : strlen($rule['rule']))}}' => '{{$rule['message']}}',
                @endforeach
            @endforeach
        ];
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('您没有权限进行此操作');
    }


    /**
    * @param Validator $validator
    * @throws AdminValidateException
    */
    protected function failedValidation(Validator $validator){
        throw new AdminValidateException($validator->errors());
    }
}
