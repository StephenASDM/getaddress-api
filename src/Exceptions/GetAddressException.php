<?php

namespace JoshThackeray\GetAddress\Exceptions;

use Exception;
use JoshThackeray\GetAddress\Exceptions\Contracts\GetAddressExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

abstract class GetAddressException extends Exception implements GetAddressExceptionInterface
{
    protected ResponseInterface $response;

    /**
     * Creates a new GetAddress exception instance.
     *
     * @param ResponseInterface $response
     * @param Throwable|null $previous
     */
    public function __construct(ResponseInterface $response, ?Throwable $previous = null)
    {
        $this->response = $response;

        parent::__construct($this->apiMessage(), $response->getStatusCode(), $previous);
    }
}