<?php
namespace App\Components\AddressByZipCode;
use Exception;
use App\Components\AddressByZipCode\Contracts\AddressByZipCodeInterface;
use App\Components\AddressByZipCode\Exceptions\AddressByZipCodeException;

class Client
{
    /**
     * @var $addressByZipCodeInterface
     */
    protected $addressByZipCodeInterface;

    /**
     * Client constructor.
     * @param AddressByZipCodeInterface $addressByZipCodeInterface
     */
    public function __construct(AddressByZipCodeInterface $addressByZipCodeInterface)
    {
        $this->addressByZipCodeInterface = $addressByZipCodeInterface;
    }

    /**
     * @param string $cep
     * @return Object
     * @throws AddressByZipCodeException
     */
    public function addressByZipCode(
        string $cep
    ): Object {
        try {
            return $this->addressByZipCodeInterface->addressByZipCode(
                $cep
            );
        } catch (Exception $exception) {            
            throw new AddressByZipCodeException(
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }
}
