<?php

namespace JoshThackeray\GetAddress\Data;

use JoshThackeray\GetAddress\Data\Contracts\AddressInterface;

class Address implements AddressInterface
{
    /**
     * Initiating the properties available.
     *
     * @var string
     */
    protected string
        $line1 = '', $line2 = '', $line3 = '', $line4 = '', $subBuildingName = '',
        $subBuildingNumber = '', $buildingName = '', $buildingNumber = '',
        $thoroughfare = '', $locality = '', $town = '', $county = '', $district = '',
        $country = '', $postcode = '', $longitude = '', $latitude = '';

    /**
     * Constructs the Address by object by interpreting the API result.
     *
     * @param $response
     */
    public function __construct($response)
    {
        if(is_string($response)) {
            $this->parseStringResponse($response);
        } else if(is_array($response)) {
            $this->parseArrayResponse($response);
        }
    }

    /**
     * Returns the Line 1 of the Address.
     *
     * @return string
     */
    public function line1(): string
    {
        return $this->line1;
    }

    /**
     * Returns the Line 3 of the Address.
     *
     * @return string
     */
    public function line2(): string
    {
        return $this->line2;
    }

    /**
     * Returns the Line 3 of the Address.
     *
     * @return string
     */
    public function line3(): string
    {
        return $this->line3;
    }

    /**
     * Returns the Line 4 of the Address.
     *
     * @return string
     */
    public function line4(): string
    {
        return $this->line4;
    }

    /**
     * Returns the Sub Building Name of the Address.
     *
     * @return string
     */
    public function subBuildingName(): string
    {
        return $this->subBuildingName;
    }

    /**
     * Returns the Sub Building Number of the Address.
     *
     * @return string
     */
    public function subBuildingNumber(): string
    {
        return $this->subBuildingNumber;
    }

    /**
     * Returns the Building Name of the Address.
     *
     * @return string
     */
    public function buildingName(): string
    {
        return $this->buildingName;
    }

    /**
     * Returns the Building Number of the Address.
     *
     * @return string
     */
    public function buildingNumber(): string
    {
        return $this->buildingNumber;
    }

    /**
     * Returns the Thoroughfare of the Address.
     *
     * @return string
     */
    public function thoroughfare(): string
    {
        return $this->thoroughfare;
    }

    /**
     * Returns the Locality of the Address.
     *
     * @return string
     */
    public function locality(): string
    {
        return $this->locality;
    }

    /**
     * Returns the Town of the Address.
     *
     * @return string
     */
    public function town(): string
    {
        return $this->town;
    }

    /**
     * Returns the County of the Address.
     *
     * @return string
     */
    public function county(): string
    {
        return $this->county;
    }

    /**
     * Returns the District of the Address.
     *
     * @return string
     */
    public function district(): string
    {
        return $this->district;
    }

    /**
     * Returns the Country of the Address.
     *
     * @return string
     */
    public function country(): string
    {
        return $this->country;
    }

    /**
     * Returns the Postcode of the Address.
     *
     * @return string
     */
    public function postcode(): string
    {
        return $this->postcode;
    }

    /**
     * Returns the Latitude of the Address.
     *
     * @return string
     */
    public function latitude(): string
    {
        return $this->latitude;
    }

    /**
     * Returns the Longitude of the Address.
     *
     * @return string
     */
    public function longitude(): string
    {
        return $this->longitude;
    }

    /**
     * Parses a string response to form this object.
     *
     * @param string $response
     * @return void
     */
    private function parseStringResponse(string $response) : void
    {
        $parts = explode(", ", $response);

        $this->line1 = $parts[0];
        $this->line2 = $parts[1];
        $this->line3 = $parts[2];
        $this->line4 = $parts[3];
        $this->locality = $parts[4];
        $this->town = $parts[5];
        $this->county = $parts[6];
    }

    /**
     * Parses a string response to form this object.
     *
     * @param array $response
     * @return void
     */
    private function parseArrayResponse(array $response) : void
    {
        $this->thoroughfare = $response['thoroughfare'];
        $this->line1 = $response['line_1'];
        $this->line2 = $response['line_2'];
        $this->line3 = $response['line_3'];
        $this->line4 = $response['line_4'];
        $this->locality = $response['locality'];
        $this->buildingName = $response['building_name'];
        $this->subBuildingName = $response['sub_building_name'];
        $this->buildingNumber = $response['building_number'];
        $this->subBuildingNumber = $response['sub_building_number'];
        $this->town = $response['town_or_city'];
        $this->county = $response['county'];
        $this->district = $response['district'];
        $this->country = $response['country'];

        $this->postcode = $response['postcode'] ?? '';
        $this->latitude = $response['latitude'] ?? '';
        $this->longitude = $response['longitude'] ?? '';
    }

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
    }
}