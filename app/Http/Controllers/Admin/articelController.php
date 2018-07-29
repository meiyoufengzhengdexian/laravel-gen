<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticelCreateRequest;
use App\Http\Requests\ArticelUpdateRequest;
use Lib\Result;
use App\Model\Articel;
        use App\Model\Cate;
                                use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class articelController extends Controller
{
    /**
     * @param  Request $request
     * @param  Articel $articel
     * @return  array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, Articel $articel)
    {
        //过滤
        $isCvsDownload = $request->input('isCvsDownload', false);
        $all = $request->input('all', false);
                                                            $id = $request->input('id', false);
                                                                                            $cate_id = $request->input('cate_id', false);
                                                                                            $title = $request->input('title', false);
                                                                                            $content = $request->input('content', false);
                                                                                            $desc = $request->input('desc', false);
                                                                                            $img = $request->input('img', false);
                                                                                                                $startCreatedAt = $request->input('startCreatedAt', false);
                        $endCreatedAt = $request->input('endCreatedAt', false);
                                                        
        $articel = $articel->orderBy('id', 'desc');

                                                        
                    $id && $articel->where('id', $id);
                                                                                    
                    $cate_id && $articel->where('cate_id', $cate_id);
                                                                                    
                    $title && $articel->where('title', $title);
                                                                                    
                    $content && $articel->where('content', $content);
                                                                                    
                    $desc && $articel->where('desc', $desc);
                                                                                    
                    $img && $articel->where('img', $img);
                                                                                                        
                    $startCreatedAt && $articel->whereRaw("DATE_FORMAT(`created_at`, '%Y-%m-%d') >= ?", [$startCreatedAt]);
                    $endCreatedAt && $articel->whereRaw("DATE_FORMAT(`created_at`, '%Y-%m-%d') >= ?", [$endCreatedAt]);
                                                                //过滤End

        //关联
                                                        $articel->with('cate');
                                                                                                                                                                        //关联End


        if($isCvsDownload){
            $list = $articel->all();
            return response()->setStatusCode(404, '暂不开放下载');
        }else{
            if(!$all){
                $list = $articel->paginate(env('PAGE_SIZE', 12));
            }else{
                $list = $articel->get();
            }

            $res = [
                'result'=>new Result(true),
                'list'=>$list
            ];

            return $res;
        }
    }


    /**
     * @param  \App\Http\Requests\ArticelCreateRequest $request
     * @return  array
     */
    public function store(ArticelCreateRequest $request)
    {
        Articel::create($request->input())->save();

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
        $data = Articel::find($id);

        return [
            'result'=>new Result(true),
            'data'=>$data,
        ];
    }


    /**
     * Update the specified resource in storage.
     *
     * @param    \App\Http\Requests\ArticelUpdateRequest  $request
     * @param    int  $id
     * @return  array
     */
    public function update(ArticelUpdateRequest $request, $id)
    {
        $articel = Articel::find($id);
        $articel->fill($request->input());
        $articel->save();


        return [
            'result'=>new Result(true),
            'articel'=>$articel
        ];
    }


    /**
     * @param  $id
     * @return  array
     */
    public function destroy($id)
    {
        Articel::destroy($id);

        return [
            'result'=>new Result(true)
        ];
    }
}
