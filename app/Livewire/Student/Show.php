<?php

namespace App\Livewire\Student;

use App\Services\Grade\GradeService;
use App\Services\Student\StudentService;
use Livewire\Component;

class Show extends Component
{
    public $student;
    public $metric;

    public function mount($id)
    {
        $this->student = app(StudentService::class)->getById($id);
        $this->metric = app(GradeService::class)->getStudentPerformanceMetrics($id);
    }

    public function render()
    {
        if (!$this->student) {
            abort(404);
        }
        
        return view('livewire.student.show');
    }
}