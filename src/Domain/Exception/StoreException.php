<?php

namespace Domain\Exception;
use Symfony\Component\HttpFoundation\Response;

class StoreException extends \Exception
{
    public function render(string $error): Response{

        return response()->json([
           'error' => [
               'message' => $error
           ]
        ]);
    }

}
