<?php

namespace JoshThackeray\GetAddress\Data\Contracts;

interface SuggestionInterface
{
    public function address() : string;

    public function url() : string;

    public function id() : string;
}