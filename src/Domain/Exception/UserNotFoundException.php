<?php

namespace Domain\Exception;
use Symfony\Component\HttpFoundation\Response;

class UserNotFoundException extends \Exception
{
    public function render(): Response{

        return response()->json([
           'error' => [
               'message' => 'user not found'
           ]
        ]);
    }

}
