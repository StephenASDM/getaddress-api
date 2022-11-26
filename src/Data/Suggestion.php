<?php

namespace JoshThackeray\GetAddress\Data;

use JoshThackeray\GetAddress\Data\Contracts\SuggestionInterface;

class Suggestion implements SuggestionInterface
{
    protected string $address;
    protected string $url;
    protected string $id;

    /**
     * Constructs the Suggestion object from an AutoComplete response.
     *
     * @param $response
     */
    public function __construct($response)
    {
        $this->address = $response['address'];
        $this->url = $response['url'];
        $this->id = $response['id'];
    }

    /**
     * Returns the address line of this suggestion.
     *
     * @return string
     */
    public function address(): string
    {
        return $this->address;
    }

    /**
     * Returns the URL to retrieve this address.
     *
     * @return string
     */
    public function url(): string
    {
        return $this->url;
    }

    /**
     * Returns the URL to ID of this address.
     *
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }
}