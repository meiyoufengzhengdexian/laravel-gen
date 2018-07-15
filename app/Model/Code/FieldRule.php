<?php

namespace App\Model\Code;

use Illuminate\Database\Eloquent\Model;

class FieldRule extends Model
{
    protected $table = 'gen_field_rule';
    protected $guarded = [];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
