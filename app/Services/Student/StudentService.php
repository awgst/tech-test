<?php

namespace App\Services\Student;

use App\Models\Student;
use App\Repositories\Student\StudentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class StudentService {
    protected StudentRepository $studentRepository;

    public function __construct(StudentRepository $studentRepository) {
        $this->studentRepository = $studentRepository;    
    }

    public function getAll(): array {
        try {
            return $this->studentRepository->getAll();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return [];
        }
    }

    public function getById(int $id): ?Student {
        try {
            return $this->studentRepository->getById($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function create(Student $student): int {
        try {
            return $this->studentRepository->create($student);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return 0;
        }
    }

    public function update(int $id, array $data): bool {
        try {
            $currentStudent = $this->studentRepository->getById($id);
            if (!$currentStudent) {
                throw new \App\Exceptions\NotFoundException();
            }

            $currentStudent->name = $data['name'];

            return $this->studentRepository->update($currentStudent);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function delete(int $id): bool {
        try {
            return $this->studentRepository->delete($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function getAllWithAssesments(): ?Collection {
        try {
            return $this->studentRepository->getAllWithAssesments();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function updateAll($students): bool {
        try {
            return $this->studentRepository->updateAll($students);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}