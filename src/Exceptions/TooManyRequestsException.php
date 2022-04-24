<?php

namespace JoshThackeray\GetAddress\Exceptions;

class TooManyRequestsException extends GetAddressException
{
    public function apiMessage(): string
    {
        return "You have made more requests than your allowed limit.";
    }
}