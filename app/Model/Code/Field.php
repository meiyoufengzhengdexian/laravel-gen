<?php

namespace App\Model\Code;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $table = 'gen_field';
    protected $guarded = [];

    public function defaultValues()
    {
        return $this->hasMany(DefaultValue::class);
    }

    public function fieldRules()
    {
        return $this->hasMany(FieldRule::class);
    }
}
