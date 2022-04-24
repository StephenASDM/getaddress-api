<?php

namespace JoshThackeray\GetAddress\Data\Contracts;

interface AddressInterface
{
    public function line1() : string;

    public function line2() : string;

    public function line3() : string;

    public function line4() : string;

    public function subBuildingName() : string;

    public function subBuildingNumber() : string;

    public function buildingName() : string;

    public function buildingNumber() : string;

    public function thoroughfare() : string;

    public function locality() : string;

    public function town() : string;

    public function county() : string;

    public function district() : string;

    public function country() : string;

    public function __toString() : string;
}