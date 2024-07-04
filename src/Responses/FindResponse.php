<?php

namespace JoshThackeray\GetAddress\Responses;

use JoshThackeray\GetAddress\Data\Address;
use JoshThackeray\GetAddress\Responses\Contracts\FindResponseInterface;

class FindResponse implements FindResponseInterface
{
    protected array $response;

    protected ?string $postcode;

    protected float $latitude;
    protected float $longitude;

    protected array $addresses = [];

    /**
     * Creates a response instance for a Find API call.
     *
     * @param $response
     */
    public function __construct($response)
    {
        $this->response = $response;

        $this->postcode = $response['postcode'] ?? null;

        $this->latitude = $response['latitude'];
        $this->longitude = $response['longitude'];

        foreach ($response['addresses'] as $address) {
            $this->addresses[] = new Address($address);
        }
    }

    /**
     * Returns the postcode value where given.
     *
     * @return ?string
     */
    public function postcode(): ?string
    {
        return $this->postcode;
    }

    /**
     * Returns the latitude value.
     *
     * @return float
     */
    public function latitude(): float
    {
        return $this->latitude;
    }

    /**
     * Returns the longitude value.
     *
     * @return float
     */
    public function longitude(): float
    {
        return $this->longitude;
    }

    /**
     * Returns an array of Address objects.
     *
     * @return array
     */
    public function addresses(): array
    {
        return $this->addresses;
    }
}
