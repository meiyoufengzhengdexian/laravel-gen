namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class {{$basicInfo['model_name']}} extends Model
{
    protected $table = '{{$tableName}}';
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    protected $connection = 'mysql';
    use SoftDeletes;

    @foreach($fields as $field)
        @if($field['is_ref'] == 1)
    public function {{ $field['ref_method'] }}() {
        return $this->{{ $field['ref_type'] }}({{ $field['ref_class'] }}::class);
    }
        @endif
    @endforeach

}
