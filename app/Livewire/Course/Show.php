<?php

namespace App\Livewire\Course;

use App\Services\Course\CourseService;
use Livewire\Component;

class Show extends Component
{
    public $course;

    public function mount($id)
    {
        $this->course = app(CourseService::class)->getById($id);
    }

    public function render()
    {
        if (!$this->course) {
            abort(404);
        }
        
        return view('livewire.course.show');
    }
}