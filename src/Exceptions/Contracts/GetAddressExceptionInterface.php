<?php

namespace JoshThackeray\GetAddress\Exceptions\Contracts;

interface GetAddressExceptionInterface
{
    public function apiMessage() : string;
}