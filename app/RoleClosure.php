<?php
namespace App;

use Franzose\ClosureTable\Models\ClosureTable;

class roleClosure extends ClosureTable implements roleClosureInterface
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'role_closure';
}
