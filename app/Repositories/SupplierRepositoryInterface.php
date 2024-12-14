<?php

namespace App\Repositories;

use App\Models\Supplier;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface SupplierRepositoryInterface
{
    public function getAllPaginated($perPage = 10): LengthAwarePaginator;

    public function create(array $data): Supplier;

    public function findById(int $id): ?Supplier;

    public function update(int $id, array $data): ?Supplier;

    public function delete(int $id): bool;
}