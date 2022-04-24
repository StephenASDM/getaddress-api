<?php

namespace JoshThackeray\GetAddress\Contracts;

use JoshThackeray\GetAddress\Responses\Contracts\AutocompleteResponseInterface;
use JoshThackeray\GetAddress\Responses\Contracts\FindResponseInterface;

interface ClientInterface
{
    public function __construct(string $apiKey);

    public function find(string $postcode, string $house = '', $expand = false) : FindResponseInterface;
}