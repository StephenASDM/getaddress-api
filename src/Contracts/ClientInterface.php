<?php

namespace JoshThackeray\GetAddress\Contracts;

use JoshThackeray\GetAddress\Responses\Contracts\AutoCompleteResponseInterface;
use JoshThackeray\GetAddress\Responses\Contracts\FindResponseInterface;

interface ClientInterface
{
    public function __construct(string $apiKey);

    public function find(string $postcode, string $house = '', $expand = false) : FindResponseInterface;

    public function autocomplete(string $term, array $options = [], int $max = 20, bool $all = false);
}