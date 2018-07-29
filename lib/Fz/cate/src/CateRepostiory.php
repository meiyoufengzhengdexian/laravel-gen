<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 2018/7/29
 * Time: 22:39
 */

namespace Lib\Fz\cate\src;


use App\Model\Cate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CateRepostiory
{
    public $request;
    public $query;

    public function __construct(Request $request, Builder $query)
    {
        $this->request = $request;
        $this->query = $query;
    }

    public function search(Builder $query=null)
    {
        $request = $this->request;
        $query = $query ? $query: $this->query;
        //过滤

        $id = $request->input('id', false);
        $name = $request->input('name', false);
        $startCreatedAt = $request->input('startCreatedAt', false);
        $endCreatedAt = $request->input('endCreatedAt', false);
        $cate_id = $request->input('cate_id', false);

        $id && $query->where('id', $id);

        $name && $query->where('name', $name);

        $startCreatedAt && $query->whereRaw("DATE_FORMAT(`created_at`, '%Y-%m-%d') >= ?", [$startCreatedAt]);
        $endCreatedAt && $query->whereRaw("DATE_FORMAT(`created_at`, '%Y-%m-%d') >= ?", [$endCreatedAt]);

        $cate_id && $query->where('cate_id', $cate_id);

        return $query;
    }
}
