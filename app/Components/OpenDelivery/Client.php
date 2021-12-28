<?php
namespace App\Components\OpenDelivery;
use Exception;
use App\Components\OpenDelivery\Contracts\DeliveryInterface;
use App\Components\OpenDelivery\Exceptions\DeliveryException;

class Client
{
    /**
     * @var $deliveryInterface
     */
    protected $deliveryInterface;

    /**
     * Client constructor.
     * @param DeliveryInterface $deliveryInterface
     */
    public function __construct(DeliveryInterface $deliveryInterface)
    {
        $this->deliveryInterface = $deliveryInterface;
    }

    /**
     * @param array $data
     * @return Object
     * @throws DeliveryException
     */
    public function delivery(
        array $data
    ): Object {
        try {
            return $this->deliveryInterface->delivery(
                $data
            );
        } catch (Exception $exception) {
            throw new DeliveryException(
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }
}
