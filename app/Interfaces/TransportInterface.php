<?php

namespace App\Interfaces;

interface TransportInterface
{
    public function createDto(): DtoInterface;
}
