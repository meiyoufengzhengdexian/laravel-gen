<?php

namespace App\Model\Code;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $table = 'gen_table';
    protected $guarded = [];


    public function fields()
    {
        return $this->hasMany(Field::class, 'gen_table_id');
    }

}
