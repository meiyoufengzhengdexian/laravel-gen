
namespace App\Http\Controllers\Admin;

use App\Http\Requests\{{ $basicInfo['model_name'] }}CreateRequest;
use App\Http\Requests\{{ $basicInfo['model_name'] }}UpdateRequest;
use App\Lib\Result;
use App\Model\{{ $basicInfo['model_name'] }};
@foreach($fields as $field)
    @if($field['is_ref'])
use App\Model\{{ $field['ref_class'] }};
    @endif
@endforeach
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class {{ $basicInfo['controller_name'] }} extends Controller
{
    /**
     * @param Request $request
     * @param {{ $basicInfo['model_name'] }} ${{ lcfirst($basicInfo['model_name']) }}
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, {{ $basicInfo['model_name'] }} ${{ lcfirst($basicInfo['model_name']) }})
    {
        //过滤
        $isCvsDownload = $request->input('isCvsDownload', false);
        $all = $request->input('all', false);
        @foreach($fields as $field)
            @if($field['search'])
                @if(!in_array($field['show_type'], ['datetime']))
                        ${{$field['name']}} = $request->input('{{$field['name']}}', false);
                    @else
                        $start{{ucfirst(camel_case($field['name']))}} = $request->input('start{{ucfirst(camel_case($field['name']))}}', false);
                        $end{{ucfirst(camel_case($field['name']))}} = $request->input('end{{ucfirst(camel_case($field['name']))}}', false);
                @endif
            @endif
        @endforeach

        ${{ lcfirst($basicInfo['model_name']) }} = ${{ lcfirst($basicInfo['model_name']) }}->orderBy('id', 'desc');

        @foreach($fields as $field)
            @if($field['search'])
                @if(!in_array($field['show_type'], ['datetime', 'checkbox']))
                    {{--普通字段， 使用where = 过滤 --}}
                    ${{$field['name']}} && ${{ lcfirst($basicInfo['model_name']) }}->where('{{$field['name']}}', ${{$field['name']}});
                @elseif($field['show_type'] == 'datetime')
                    {{-- 时间字段， 使用时间范围过滤 --}}
                    $start{{ucfirst(camel_case($field['name']))}} && ${{ lcfirst($basicInfo['model_name']) }}->whereRaw("DATE_FORMAT(`{{$field['name']}}`, '%Y-%m-%d') >= ?", [$start{{ucfirst(camel_case($field['name']))}}]);
                    $end{{ucfirst(camel_case($field['name']))}} && ${{ lcfirst($basicInfo['model_name']) }}->whereRaw("DATE_FORMAT(`{{$field['name']}}`, '%Y-%m-%d') >= ?", [$end{{ucfirst(camel_case($field['name']))}}]);
                @elseif($field['show_type'] == 'checkbox')
                    {{-- checkbox 使用whereIn 过滤--}}
                    ${{$field['name']}} && ${{ lcfirst($basicInfo['model_name']) }}->whereIn('{{$field['name']}}', ${{$field['name']}});
                @endif
            @endif
        @endforeach
        //过滤End

        //关联
        @foreach($fields as $field)
            @if($field['is_ref'])
                ${{ lcfirst($basicInfo['model_name']) }}->with('{{$field['ref_method']}}');
            @endif
        @endforeach
        //关联End


        if($isCvsDownload){
            $list = ${{ lcfirst($basicInfo['model_name']) }}->all();
            return response()->setStatusCode(404, '暂不开放下载');
        }else{
            if(!$all){
                $list = ${{ lcfirst($basicInfo['model_name']) }}->paginate(env('PAGE_SIZE', 12));
            }else{
                $list = ${{ lcfirst($basicInfo['model_name']) }}->get();
            }

            $res = [
                'result'=>new Result(true),
                'list'=>$list
            ];

            return $res;
        }
    }


    /**
     * @param \App\Http\Requests\{{ $basicInfo['model_name'] }}CreateRequest $request
     * @return array
     */
    public function store({{ $basicInfo['model_name'] }}CreateRequest $request)
    {
        {{ $basicInfo['model_name'] }}::create($request->input())->save();

        return [
            'result'=> new Result(true),
            'request'=>$request->input()
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return array
     */
    public function show($id)
    {
        $data = {{ $basicInfo['model_name'] }}::find($id);

        return [
            'result'=>new Result(true),
            'data'=>$data,
        ];
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\{{ $basicInfo['model_name'] }}UpdateRequest  $request
     * @param  int  $id
     * @return array
     */
    public function update({{ $basicInfo['model_name'] }}UpdateRequest $request, $id)
    {
        ${{ lcfirst($basicInfo['model_name']) }} = {{ $basicInfo['model_name'] }}::find($id);
        ${{ lcfirst($basicInfo['model_name']) }}->fill($request->input());
        ${{ lcfirst($basicInfo['model_name']) }}->save();


        return [
            'result'=>new Result(true),
            '{{ lcfirst($basicInfo['model_name']) }}'=>${{ lcfirst($basicInfo['model_name']) }}
        ];
    }


    /**
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        {{ $basicInfo['model_name'] }}::destroy($id);

        return [
            'result'=>new Result(true)
        ];
    }
}
