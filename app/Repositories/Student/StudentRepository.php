<?php

namespace App\Repositories\Student;

use App\Models\Student;

interface StudentRepository
{
    /**
     * Get all students
     * 
     * @return array
     */
    public function getAll(): array;

    /**
     * Get a student by id
     * 
     * @param int $id
     * @return Student|null
     */
    public function getById(int $id): ?Student;

    /**
     * Create a student
     * 
     * @param Student $student 
     * @return int
     */
    public function create(Student $student): int;

    /**
     * Update a student
     * 
     * @param int $id
     * @param Student $student
     * @return bool
     */
    public function update(Student $student);

    /**
     * Delete a student
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id);
}