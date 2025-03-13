<?php

namespace App\Repositories\Assesment;

use App\Models\Assesment\Assesment;
use App\Repositories\Assesment\AssesmentRepository;
use Illuminate\Support\Facades\Log;

class EloquentAssesmentRepository implements AssesmentRepository
{
    protected Assesment $model;

    public function __construct(Assesment $model)
    {
        $this->model = $model;
    }

    public function getAll(): array
    {
        try {
            return $this->model->with(['student', 'course'])->get()->toArray();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return [];
        }
    }

    public function getById(int $id): ?Assesment
    {
        try {
            return $this->model->with(['student', 'course'])->find($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function create(Assesment $assesment): int
    {
        try {
            return $this->model->create($assesment->toArray())->id;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return 0;
        }
    }

    public function update(Assesment $assesment): bool
    {
        try {
            return $assesment->save();
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

    public function getByStudentIdAndType(int $studentId, string $type): array
    {
        try {
            return $this->model
                ->where('student_id', $studentId)
                ->where('types', $type)
                ->get()
                ->toArray();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return [];
        }
    }
}