<?php

use JoshThackeray\GetAddress\Client;
use JoshThackeray\GetAddress\Data\Address;
use JoshThackeray\GetAddress\Data\Suggestion;
use JoshThackeray\GetAddress\Exceptions\IdNotFoundException;
use PHPUnit\Framework\TestCase;

class AutocompleteTest extends TestCase
{
    private string $apiKey = '-- ENTER API KEY --';

    public function testAutocompleteWithInvalidTerm()
    {
        $client = new Client($this->apiKey);
        $response = $client->autocomplete('This is an invalid search term');
        $this->assertEmpty($response->suggestions());
    }

    public function testAutocompleteWithValidTerm()
    {
        $client = new Client($this->apiKey);
        $response = $client->autocomplete('Homestead Road');
        $this->assertCount(6, $response->suggestions());
    }

    public function testAutocompleteWithValidTermExtendedResults()
    {
        $client = new Client($this->apiKey);
        $response = $client->autocomplete('Homestead Road', [], 20);
        $this->assertCount(20, $response->suggestions());
    }

    public function testAutocompleteWithFilteredTown()
    {
        $client = new Client($this->apiKey);
        $response = $client->autocomplete('Homestead Road', [
            'filter' => [
                'town_or_city' => 'sheffield'
            ]
        ]);

        $this->assertCount(6, $response->suggestions());

        $this->assertArrayHasKey(0, $response->suggestions());
        $this->assertInstanceOf(Suggestion::class, $response->suggestions()[0]);
        $this->assertStringContainsString("Sheffield", $response->suggestions()[0]->address());
    }

    public function testAutoCompleteWithoutLocationProximity()
    {
        $client = new Client($this->apiKey);
        $response = $client->autocomplete('Homestead Road');

        $this->assertCount(6, $response->suggestions());

        $this->assertArrayHasKey(0, $response->suggestions());
        $this->assertInstanceOf(Suggestion::class, $response->suggestions()[0]);
        $this->assertStringContainsString("London", $response->suggestions()[0]->address());
    }

    public function testAutoCompleteWithLocationProximity()
    {
        $client = new Client($this->apiKey);
        $response = $client->autocomplete('Homestead Road', [
            'location' => [
                'latitude' => '53.42416763305664',
                'longitude' => '-1.45220148563385'
            ]
        ]);

        $this->assertCount(6, $response->suggestions());

        $this->assertArrayHasKey(0, $response->suggestions());
        $this->assertInstanceOf(Suggestion::class, $response->suggestions()[0]);
        $this->assertStringContainsString("Sheffield", $response->suggestions()[0]->address());
    }

    public function testGetResultFromInvalidID()
    {
        $this->expectException(IdNotFoundException::class);
        $client = new Client($this->apiKey);
        $client->get('This is an invalid ID');
    }

    public function testGetResultFromValidSuggestion()
    {
        $client = new Client($this->apiKey);
        $response = $client->autocomplete('Homestead Road');

        $this->assertArrayHasKey(0, $response->suggestions());
        $this->assertInstanceOf(Suggestion::class, $response->suggestions()[0]);
        $this->assertStringContainsString("London", $response->suggestions()[0]->address());

        $result = $client->get($response->suggestions()[0]->id());

        $this->assertIsObject($result);
        $this->assertInstanceOf(Address::class, $result);
        $this->assertEquals("London", $result->town());
    }
}