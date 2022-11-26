<?php

namespace JoshThackeray\GetAddress\Exceptions;

class IdNotFoundException extends GetAddressException
{
    public function apiMessage(): string
    {
        return "No address could be found for this ID.";
    }
}