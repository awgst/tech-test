<?php

namespace App\Services\Course;

use App\Models\Course;
use App\Repositories\Course\CourseRepository;
use Illuminate\Support\Facades\Log;

class CourseService
{
    protected CourseRepository $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function getAll(): array
    {
        try {
            return $this->courseRepository->getAll();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return [];
        }
    }

    public function getById(int $id): ?Course {
        try {
            return $this->courseRepository->getById($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function create(array $data): int
    {
        try {
            return $this->courseRepository->create($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return 0;
        }
    }

    public function update(int $id, array $data): bool
    {
        try {
            $course = $this->courseRepository->getById($id);
            if (!$course) {
                throw new \App\Exceptions\NotFoundException();
            }

            return $course->update($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function delete(int $id): bool
    {
        try {
            return $this->courseRepository->delete($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}