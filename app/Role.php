<?php
namespace App;

use Franzose\ClosureTable\Models\Entity;

class role extends Entity implements roleInterface
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * ClosureTable model instance.
     *
     * @var roleClosure
     */
    protected $closure = 'App\roleClosure';
}
