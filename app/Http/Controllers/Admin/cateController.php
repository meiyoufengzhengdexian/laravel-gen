<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\CateCreateRequest;
use App\Http\Requests\CateUpdateRequest;
use App\Lib\Result;
use App\Model\Cate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class cateController extends Controller
{
    /**
     * @param  Request $request
     * @param  Cate $cate
     * @return  array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, Cate $cate)
    {
        //过滤
        $isCvsDownload = $request->input('isCvsDownload', false);
        $all = $request->input('all', false);
                                                            $id = $request->input('id', false);
                                                                                            $name = $request->input('name', false);
                                                                                            $cate_id = $request->input('cate_id', false);
                                                                                            $startCreatedAt = $request->input('startCreatedAt', false);
                        $endCreatedAt = $request->input('endCreatedAt', false);
                                                                                        $startUpdatedAt = $request->input('startUpdatedAt', false);
                        $endUpdatedAt = $request->input('endUpdatedAt', false);
                                                                                        $startDeletedAt = $request->input('startDeletedAt', false);
                        $endDeletedAt = $request->input('endDeletedAt', false);
                                    
                                                        
                    $id && $cate->where('id', $id);
                                                                                    
                    $name && $cate->where('name', $name);
                                                                                    
                    $cate_id && $cate->where('cate_id', $cate_id);
                                                                                    
                    $startCreatedAt && $cate->whereRaw("DATE_FORMAT(`created_at`, '%Y-%m-%d') >= ?", [$startCreatedAt]);
                    $endCreatedAt && $cate->whereRaw("DATE_FORMAT(`created_at`, '%Y-%m-%d') >= ?", [$endCreatedAt]);
                                                                                    
                    $startUpdatedAt && $cate->whereRaw("DATE_FORMAT(`updated_at`, '%Y-%m-%d') >= ?", [$startUpdatedAt]);
                    $endUpdatedAt && $cate->whereRaw("DATE_FORMAT(`updated_at`, '%Y-%m-%d') >= ?", [$endUpdatedAt]);
                                                                                    
                    $startDeletedAt && $cate->whereRaw("DATE_FORMAT(`deleted_at`, '%Y-%m-%d') >= ?", [$startDeletedAt]);
                    $endDeletedAt && $cate->whereRaw("DATE_FORMAT(`deleted_at`, '%Y-%m-%d') >= ?", [$endDeletedAt]);
                                            //过滤End

        //关联
        //关联End

        $cate = $cate->orderBy('id', 'desc');

        if($isCvsDownload){
            $list = $cate->all();
            return response()->setStatusCode(404, '暂不开放下载');
        }else{
            if(!$all){
                $list = $cate->paginate(env('PAGE_SIZE', 12));
            }else{
                $list = $cate->get();
            }

            $res = [
                'result'=>new Result(true),
                'list'=>$list
            ];

            return $res;
        }
    }


    /**
     * @param  \App\Http\Requests\CateCreateRequest $request
     * @return  array
     */
    public function store(CateCreateRequest $request)
    {
        Cate::create($request->input())->save();

        return [
            'result'=> new Result(true),
            'request'=>$request->input()
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param    int  $id
     * @return  array
     */
    public function show($id)
    {
        $data = Cate::find($id);

        return [
            'result'=>new Result(true),
            'data'=>$data,
        ];
    }


    /**
     * Update the specified resource in storage.
     *
     * @param    \App\Http\Requests\CateUpdateRequest  $request
     * @param    int  $id
     * @return  array
     */
    public function update(CateUpdateRequest $request, $id)
    {
        $cate = Cate::find($id);
        $cate->fill($request->input());
        $cate->save();


        return [
            'result'=>new Result(true),
            'cate'=>$$cate
        ];
    }


    /**
     * @param  $id
     * @return  array
     */
    public function destroy($id)
    {
        Cate::destroy($id);

        return [
            'result'=>new Result(true)
        ];
    }
}
