<?php

namespace App\Services\Grade;

use App\Services\Assesment\AssesmentService;
use App\Services\Student\StudentService;
use App\Services\Course\CourseService;
use App\Constants\AssesmentType;
use Illuminate\Support\Facades\Log;

class GradeService
{
    protected AssesmentService $assesmentService;
    protected StudentService $studentService;

    public function __construct(
        AssesmentService $assesmentService,
        StudentService $studentService
    ) {
        $this->assesmentService = $assesmentService;
        $this->studentService = $studentService;
    }

    public function getStudentPerformanceMetrics(int $studentId): array
    {
        try {
            $student = $this->studentService->getById($studentId);
            if (!$student) {
                throw new \App\Exceptions\NotFoundException();
            }
            
            $metrics = [];
            foreach (AssesmentType::toArray() as $type) {
                $assessments = $this->assesmentService->getByStudentAndType($studentId, $type);
                if (empty($assessments)) {
                    $metrics[$type] = 0;
                    continue;
                }
                $totalScore = 0;
                foreach ($assessments as $assessment) {
                    $totalScore += $assessment['scores'];
                }
                $metrics[$type] = round($totalScore / count($assessments), 2);
            }

            return $metrics;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return [];
        }
    }
}