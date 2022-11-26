<?php

namespace JoshThackeray\GetAddress\Responses;

use JoshThackeray\GetAddress\Data\Address;
use JoshThackeray\GetAddress\Data\Suggestion;
use JoshThackeray\GetAddress\Responses\Contracts\AutoCompleteResponseInterface;
use JoshThackeray\GetAddress\Responses\Contracts\FindResponseInterface;

class AutoCompleteResponse implements AutoCompleteResponseInterface
{
    protected array $response;

    protected array $suggestions;

    /**
     * Creates a response instance for a Find API call.
     *
     * @param $response
     */
    public function __construct($response)
    {
        $this->response = $response;

        $this->suggestions = [];
        foreach ($response['suggestions'] as $suggestion) {
            $this->suggestions[] = new Suggestion($suggestion);
        }
    }

    /**
     * Returns an array of suggestions from this AutoComplete response.
     *
     * @return array|Suggestion[]
     */
    public function suggestions(): array
    {
        return $this->suggestions;
    }
}