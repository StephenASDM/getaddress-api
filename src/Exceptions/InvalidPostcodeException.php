<?php

namespace JoshThackeray\GetAddress\Exceptions;

class InvalidPostcodeException extends GetAddressException
{
    public function apiMessage(): string
    {
        return "Your postcode is not valid.";
    }
}