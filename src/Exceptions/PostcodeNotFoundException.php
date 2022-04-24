<?php

namespace JoshThackeray\GetAddress\Exceptions;

class PostcodeNotFoundException extends GetAddressException
{
    public function apiMessage(): string
    {
        return "No addresses could be found for this postcode.";
    }
}