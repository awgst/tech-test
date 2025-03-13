<?php

namespace App\Services\Grade;

use App\Services\Assesment\AssesmentService;
use App\Services\Student\StudentService;
use App\Services\Course\CourseService;
use App\Constants\AssesmentType;
use App\Models\Assesment\HasGradeWeight;
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

    public function calculateFinalGrades(): array
    {
        try {
            $students = $this->studentService->getAllWithAssesments();
            for ($i=0; $i < count($students); $i++) { 
                $students[$i]->final_grade = $this->calculateFinalGrade($students[$i]->assesments);   
                $students[$i]->final_grade_letter = $this->gradeLetter($students[$i]->final_grade);
            }

            if (!$this->studentService->updateAll($students)) {
                throw new \Exception('failed to update students');
            }

            return $students->toArray();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return [];
        }
    }

    private function gradeLetter($scores)
    {
        if ($scores >= 90) {
            if ($scores >= 95) {
                return 'A+';
            }
            return 'A';
        } elseif ($scores >= 80) {
            return 'B';
        } elseif ($scores >= 70) {
            return 'C';
        } elseif ($scores >= 60) {
            return 'D';
        } else {
            return 'F';
        }
    }

    /**
     * @param Assessment[] $assessments
     */
    private function calculateFinalGrade($assessments)
    {
        $totalScore = 0;
        foreach ($assessments as $assesment) {
            $totalScore += $assesment->scores * $assesment->toType()->getGradeWeight();
        }

        if ($totalScore > 100) {
            return 100;
        }

        if ($totalScore <= 0) {
            return 0;
        }

        return $totalScore;
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