<?php
namespace App\Components\MercadoPagoIntegration;
use Exception;
use App\Components\MercadoPagoIntegration\Contracts\MercadoPagoInterface;
use App\Components\MercadoPagoIntegration\Exceptions\MercadoPagoException;

class Client
{
    /**
     * @var mercadoPagoInterface
     */
    protected $mercadoPagoInterface;

    /**
     * Client constructor.
     * @param MercadoPagoInterface $mercadoPagoInterface
     */
    public function __construct(MercadoPagoInterface $mercadoPagoInterface)
    {
        $this->mercadoPagoInterface = $mercadoPagoInterface;
    }

    /**
     * @param $request
     * @return Object
     * @throws MercadoPagoException
     */
    public function generatePayment(
        $request
    ): Object {
        try {
            return $this->mercadoPagoInterface->generatePayment(
                $request
            );
        } catch (Exception $exception) {
            throw new MercadoPagoException(
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }

    /**
     * @return Object
     * @throws MercadoPagoException
     */
    public function getIdentificationType(
    ): Object {
        try {
            return $this->mercadoPagoInterface->getIdentificationType();
        } catch (Exception $exception) {
            throw new MercadoPagoException(
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }

    /**
     * @param $request
     * @return Object
     * @throws MercadoPagoException
     */
    public function createsCustomer(
        $request
    ): Object {
        try {
            return $this->mercadoPagoInterface->createsCustomer(
                $request
            );
        } catch (Exception $exception) {
            throw new MercadoPagoException(
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }

    /**
     * @return Object
     * @throws MercadoPagoException
     */
    public function getCustomer(
        $id
    ): Object {
        try {
            return $this->mercadoPagoInterface->getCustomer(
                $id
            );
        } catch (Exception $exception) {
            throw new MercadoPagoException(
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }

    /**
     * @param $request & &customerID
     * @return Object
     * @throws MercadoPagoException
     */
    public function createsCard(
        $request, $customerID
    ): Object {
        try {
            return $this->mercadoPagoInterface->createsCard(
                $request, $customerID
            );
        } catch (Exception $exception) {
            throw new MercadoPagoException(
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }

    /**
     * @return Object
     * @throws MercadoPagoException
     */
    public function getCards(
        $customerID
    ): Object {
        try {
            return $this->mercadoPagoInterface->getCards(
                $customerID
            );
        } catch (Exception $exception) {
            throw new MercadoPagoException(
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }

    /**
     * @param $customerID & $id
     * @return Object
     * @throws MercadoPagoException
     */
    public function deleteCard(
        $customerID, $id
    ): Object {
        try {
            return $this->mercadoPagoInterface->deleteCard(
                $customerID, $id
            );
        } catch (Exception $exception) {
            throw new MercadoPagoException(
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }

    /**
     * @param $request
     * @return Object
     * @throws MercadoPagoException
     */
    public function createsPayment(
        $request
    ): Object {
        try {
            return $this->mercadoPagoInterface->createsPayment(
                $request
            );
        } catch (Exception $exception) {
            throw new MercadoPagoException(
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }
}
