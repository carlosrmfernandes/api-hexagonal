<?php

namespace App\Components\MercadoPagoIntegration\Exceptions;

use Exception;
use Throwable;
use Illuminate\Support\Facades\Log;

class MercadoPagoException extends Exception
{
    /**
     * MercadoPagoException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        $message = '',
        $code = 500,
        Throwable $previous = null
    ) {
        Log::error('Mercado Pago Error: ' . $message);
        parent::__construct($message, $code, $previous);
    }
}