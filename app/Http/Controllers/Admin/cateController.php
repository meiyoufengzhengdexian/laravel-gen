<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CateCreateRequest;
use App\Http\Requests\CateUpdateRequest;
use Lib\Fz\cate\src\CateRepostiory;
use Lib\Result;
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
    public function index(Request $request, CateRepostiory $cateRepostiory)
    {

        $isCvsDownload = $request->input('isCvsDownload');
        $all = $request->input('all');

        $cate = $cateRepostiory->search();

        if ($isCvsDownload) {
            $list = $cate->all();
            return response()->setStatusCode(404, '暂不开放下载');
        } else {
            if (!$all) {
                $list = $cate->paginate(env('PAGE_SIZE', 12));
            } else {
                $list = $cate->get();
            }

            $res = [
                'result' => new Result(true),
                'list' => $list
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
            'result' => new Result(true),
            'request' => $request->input()
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param    int $id
     * @return  array
     */
    public function show($id)
    {
        $data = Cate::find($id);

        return [
            'result' => new Result(true),
            'data' => $data,
        ];
    }


    /**
     * Update the specified resource in storage.
     *
     * @param    \App\Http\Requests\CateUpdateRequest $request
     * @param    int $id
     * @return  array
     */
    public function update(CateUpdateRequest $request, $id)
    {
        $cate = Cate::find($id);
        $cate->fill($request->input());
        $cate->save();


        return [
            'result' => new Result(true),
            'cate' => $cate
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
            'result' => new Result(true)
        ];
    }
}
