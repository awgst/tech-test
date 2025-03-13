<?php

namespace App\Services\Assesment;

use App\Models\Assesment\Assesment;
use App\Repositories\Assesment\AssesmentRepository;
use Illuminate\Support\Facades\Log;

class AssesmentService
{
    protected AssesmentRepository $repository;

    public function __construct(AssesmentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all assessments
     *
     * @return array
     */
    public function getAll(): array
    {
        try {
            return $this->repository->getAll();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return [];
        }
    }

    /**
     * Get assessment by ID
     *
     * @param int $id
     * @return Assesment|null
     */
    public function getById(int $id): ?Assesment
    {
        try {
            return $this->repository->getById($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    /**
     * Create a new assessment
     *
     * @param Assesment $assessment
     * @return int
     */
    public function create(Assesment $assessment): int
    {
        try {
            return $this->repository->create($assessment);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return 0;
        }
    }

    /**
     * Update an existing assessment
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        try {
            $assessment = $this->repository->getById($id);
            if ($assessment === null) {
                throw new \App\Exceptions\NotFoundException();
            }

            $assessment->fill($data);
            return $this->repository->update($assessment);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * Delete an assessment
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        try {
            return $this->repository->delete($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * Get assessments by student ID and type
     *
     * @param int $studentId
     * @param string $type
     * @return array
     */
    public function getByStudentAndType(int $studentId, string $type): array
    {
        try {
            return $this->repository->getByStudentIdAndType($studentId, $type);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return [];
        }
    }
}