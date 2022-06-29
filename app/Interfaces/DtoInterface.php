<?php

namespace App\Interfaces;

interface DtoInterface
{
    public function createFromRequest(array $fields): DtoInterface;
}
