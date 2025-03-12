<?php

namespace App\Repositories\Course;

use App\Models\Course;
use Illuminate\Support\Facades\Log;

class EloquentCourseRepository implements CourseRepository
{
    protected Course $model;

    public function __construct(Course $model)
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

    public function getById(int $id): ?Course
    {
        try {
            return $this->model->find($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function create(array $data): int
    {
        try {
            $result = $this->model->create($data);
            return $result->id;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function update(Course $course): bool
    {
        try {
            return $course->save();
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