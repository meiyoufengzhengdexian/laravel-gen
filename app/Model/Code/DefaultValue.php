<?php

namespace App\Model\Code;

use Illuminate\Database\Eloquent\Model;

class DefaultValue extends Model
{
    protected $table = 'gen_default_value';
    protected $guarded = [];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
