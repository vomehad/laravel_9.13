<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function getAll(array $options = []);

    public function getOne(int $id): ?Model;

    public function add(): array;

    public function create(DtoInterface $dto): ?int;

    public function edit(int $id);

    public function update(DtoInterface $dto): ?int;

    public function remove(int $id): string;

    public function restore(int $id): string;
}
