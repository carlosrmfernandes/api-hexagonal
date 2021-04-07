<?php
namespace App\Components\MercadoPagoIntegration;
use Exception;
use App\Components\MercadoPagoIntegration\Contracts\MercadoPagoInterface;
use App\Components\MercadoPagoIntegration\Exceptions\MercadoPagoException;

class Client
{
    /**
     * @var MercadoPagoInterface
     */
    protected $MercadoPagoInterface;

    /**
     * Client constructor.
     * @param MercadoPagoInterface $MercadoPagoInterface
     */
    public function __construct(MercadoPagoInterface $MercadoPagoInterface)
    {
        $this->MercadoPagoInterface = $MercadoPagoInterface;
    }

    /**
     * @param int $id
     * @return Object
     * @throws MercadoPagoException
     */
    public function generateWeather(
        int $id
    ): Object {
        try {
            return $this->MercadoPagoInterface->generateWeather(
                $id
            );
        } catch (Exception $exception) {
            throw new MercadoPagoException(
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }
}
