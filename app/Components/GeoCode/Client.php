<?php
namespace App\Components\GeoCode;
use Exception;
use App\Components\GeoCode\Contracts\GeoCodeInterface;
use App\Components\GeoCode\Exceptions\GeoCodeException;

class Client
{
    /**
     * @var $geoCodeInterface
     */
    protected $geoCodeInterface;

    /**
     * Client constructor.
     * @param GeoCodeInterface $geoCodeInterface
     */
    public function __construct(GeoCodeInterface $geoCodeInterface)
    {
        $this->geoCodeInterface = $geoCodeInterface;
    }

    /**
     * @param array $data
     * @return Object
     * @throws GeoCodeException
     */
    public function geoCode(
        array $data
    ): Object {
        try {
            return $this->geoCodeInterface->geoCode(
                $data
            );
        } catch (Exception $exception) {            
            throw new GeoCodeException(
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }
}
