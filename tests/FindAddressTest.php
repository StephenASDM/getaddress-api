<?php

use JoshThackeray\GetAddress\Client;
use JoshThackeray\GetAddress\Data\Address;
use JoshThackeray\GetAddress\Exceptions\AccessForbiddenException;
use JoshThackeray\GetAddress\Exceptions\InvalidApiKeyException;
use JoshThackeray\GetAddress\Exceptions\InvalidPostcodeException;
use JoshThackeray\GetAddress\Exceptions\TooManyRequestsException;
use JoshThackeray\GetAddress\Responses\FindResponse;
use PHPUnit\Framework\TestCase;

class FindAddressTest extends TestCase
{
    private string $apiKey = '-- PLACE API KEY HERE --';

    public function testFindAddressWithInvalidPostcode()
    {
        $this->expectException(InvalidPostcodeException::class);
        $this->expectExceptionMessage("Your postcode is not valid.");
        $client = new Client($this->apiKey);
        $client->find("XX4 00X");
    }

    public function testFindAddressWithInvalidApiKey()
    {
        $this->expectException(InvalidApiKeyException::class);
        $this->expectExceptionMessage("Your api-key is not valid.");
        $client = new Client($this->apiKey);
        $client->find("XX4 01X");
    }

    public function testFindAddressWithValidButForbiddenApiKey()
    {
        $this->expectException(AccessForbiddenException::class);
        $this->expectExceptionMessage("Your api-key is valid but you do not have permission to access to the resource.");
        $client = new Client($this->apiKey);
        $client->find("XX4 03X");
    }

    public function testFindAddressWithValidButTooManyUsedRequests()
    {
        $this->expectException(TooManyRequestsException::class);
        $this->expectExceptionMessage("You have made more requests than your allowed limit.");
        $client = new Client($this->apiKey);
        $client->find("XX4 29X");
    }

    public function testFindAddressWithValidPostcodeNotExpanded()
    {
        $client = new Client($this->apiKey);
        $response = $client->find("KW1 4YT");

        $this->assertIsObject($response);
        $this->assertEquals(FindResponse::class, get_class($response));

        $this->assertEquals(58.6356815, $response->latitude());
        $this->assertEquals(-3.0614963, $response->longitude());

        $this->assertCount(16, $response->addresses());
        /** @var Address $first_address */
        $first_address = $response->addresses()[0];

        $this->assertIsObject($first_address);
        $this->assertEquals(Address::class, get_class($first_address));

        $this->assertEquals("1 Heatherbell Cottages", $first_address->line1());
        $this->assertEmpty($first_address->line2());
        $this->assertEmpty($first_address->line3());
        $this->assertEmpty($first_address->line4());

        $this->assertEmpty($first_address->buildingNumber());
        $this->assertEmpty($first_address->buildingName());
        $this->assertEmpty($first_address->subBuildingNumber());
        $this->assertEmpty($first_address->subBuildingName());

        $this->assertEquals("John O' Groats", $first_address->locality());
        $this->assertEquals("Wick", $first_address->town());
        $this->assertEquals("Caithness", $first_address->county());
        $this->assertEmpty($first_address->country());
    }

    public function testFindAddressWithValidPostcodeExpanded()
    {
        $client = new Client($this->apiKey);
        $response = $client->find("KW1 4YT", '', true);

        $this->assertIsObject($response);
        $this->assertEquals(FindResponse::class, get_class($response));

        $this->assertEquals(58.6356815, $response->latitude());
        $this->assertEquals(-3.0614963, $response->longitude());

        $this->assertCount(16, $response->addresses());
        /** @var Address $first_address */
        $first_address = $response->addresses()[0];

        $this->assertIsObject($first_address);
        $this->assertEquals(Address::class, get_class($first_address));

        $this->assertEquals("Heatherbell Cottages", $first_address->thoroughfare());
        $this->assertEquals("1 Heatherbell Cottages", $first_address->line1());
        $this->assertEmpty($first_address->line2());
        $this->assertEmpty($first_address->line3());
        $this->assertEmpty($first_address->line4());

        $this->assertEquals("1", $first_address->buildingNumber());
        $this->assertEmpty($first_address->buildingName());
        $this->assertEmpty($first_address->subBuildingNumber());
        $this->assertEmpty($first_address->subBuildingName());

        $this->assertEquals("John O' Groats", $first_address->locality());
        $this->assertEquals("Wick", $first_address->town());
        $this->assertEquals("Caithness", $first_address->county());
        $this->assertEquals("Highland", $first_address->district());
        $this->assertEquals("Scotland", $first_address->country());
    }

    public function testFindAddressWithValidPostcodeAndHouseExpanded()
    {
        $client = new Client($this->apiKey);
        $response = $client->find("KW1 4YT", '7', true);

        $this->assertIsObject($response);
        $this->assertEquals(FindResponse::class, get_class($response));

        $this->assertEquals(58.6356815, $response->latitude());
        $this->assertEquals(-3.0614963, $response->longitude());

        $this->assertCount(1, $response->addresses());
    }
}