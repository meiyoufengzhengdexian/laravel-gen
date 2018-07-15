<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 2018/7/14
 * Time: 22:23
 */

namespace App\Exceptions;


use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

class AdminValidateException extends Exception implements Responsable
{
    public $errors ;
    public function __construct($errors, $message='')
    {
        $this->errors = $errors;
        parent::__construct(collect($errors)->first()[0]);
    }
    public function toResponse($request)
    {
        return (new JsonResponse([
            'errors'=>$this->errors,
            'message'=>$this->message
        ], 422))->prepare($request);
    }

}
