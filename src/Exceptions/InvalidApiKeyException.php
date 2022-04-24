<?php

namespace JoshThackeray\GetAddress\Exceptions;

class InvalidApiKeyException extends GetAddressException
{
    public function apiMessage(): string
    {
        return "Your api-key is not valid.";
    }
}