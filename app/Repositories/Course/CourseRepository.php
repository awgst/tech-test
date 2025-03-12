<?php

namespace App\Repositories\Course;

use App\Models\Course;

interface CourseRepository
{
    /**
     * Get all courses
     */
    public function getAll(): array;

    /**
     * Get a course by id
     *
     * @param int $id
     * @return Course|null
     */
    public function getById(int $id): ?Course;

    /**
     * Create a course
     *
     * @param array $data
     * @return int
     */
    public function create(array $data): int;

    /**
     * Update a course
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(Course $course): bool;

    /**
     * Delete a course
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}