<?php
namespace App\Components\Delivery;
use Exception;
use App\Components\Delivery\Contracts\DeliveryInterface;
use App\Components\Delivery\Exceptions\DeliveryException;

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
