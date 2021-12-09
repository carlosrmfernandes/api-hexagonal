<?php

namespace App\Components\GeoCode\Exceptions;

use Exception;
use Throwable;
use Illuminate\Support\Facades\Log;

class GeoCodeException extends Exception
{
    /**
     * GeoCodeException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        $message = '',
        $code = 500,
        Throwable $previous = null
    ) {
        
        Log::error('Delivery Error: ' . $message);
        parent::__construct($message, $code, $previous);
    }
}
