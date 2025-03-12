<?php

namespace App\Repositories\Student;

use App\Models\Student;
use Illuminate\Support\Facades\Log;

class EloquentStudentRepository implements StudentRepository
{
    protected Student $model;

    public function __construct(Student $model)
    {
        $this->model = $model;
    }

    public function getAll(): array
    {
        try {
            return $this->model->all()->toArray();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return [];
        }
    }

    public function getById(int $id): ?Student
    {
        try {
            return $this->model->find($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function create(Student $student): int
    {
        try {
            $newStudent = $this->model->create($student->toArray());
            return $newStudent->id;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return 0;
        }
    }

    public function update(Student $student): bool
    {
        try {
            return $student->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function delete(int $id): bool
    {
        try {
            return $this->model->destroy($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

}