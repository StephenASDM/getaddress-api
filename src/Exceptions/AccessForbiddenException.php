<?php

namespace JoshThackeray\GetAddress\Exceptions;

class AccessForbiddenException extends GetAddressException
{
    public function apiMessage(): string
    {
        return "Your api-key is valid but you do not have permission to access to the resource.";
    }
}