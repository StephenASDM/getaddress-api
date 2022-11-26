<?php

namespace JoshThackeray\GetAddress\Responses\Contracts;

interface AutoCompleteResponseInterface
{
    public function suggestions(): array;
}