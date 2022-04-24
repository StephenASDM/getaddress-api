<?php

namespace JoshThackeray\GetAddress\Responses\Contracts;

interface FindResponseInterface
{
    public function __construct($response);

    public function latitude() : float;

    public function longitude() : float;

    public function addresses() : array;
}