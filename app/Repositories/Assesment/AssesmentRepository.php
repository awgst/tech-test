<?php

namespace App\Repositories\Assesment;

use App\Models\Assesment\Assesment;

interface AssesmentRepository
{
    /**
     * Get all assesments
     *
     * @return array
     */
    public function getAll(): array;

    /**
     * Get a assesment by id
     *
     * @param int $id
     * @return Assesment|null
     */
    public function getById(int $id): ?Assesment;

    /**
     * Create a assesment
     *
     * @param Assesment $assesment
     * @return int
     */
    public function create(Assesment $assesment): int;

    /**
     * Update a assesment
     *
     * @param Assesment $assesment
     * @return bool
     */
    public function update(Assesment $assesment): bool;

    /**
     * Delete a assesment
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}