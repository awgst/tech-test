<?php

namespace App\Livewire\Assesment;

use App\Constants\AssesmentType;
use App\Models\Course;
use App\Models\Student;
use App\Services\Assesment\AssesmentService;
use App\Services\Course\CourseService;
use App\Services\Student\StudentService;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    protected $assesment;
    public $id;
    public $student_id;
    public $course_id;
    public $types;
    public $scores;

    protected function rules()
    { 
        return [
            'course_id' => 'required|int',
            'student_id' => 'required|int',
            'types' => ['required', Rule::in(AssesmentType::toArray())],
            'scores' => 'required|numeric|between:0,100',
        ];
    }

    protected AssesmentService $assesmentService;
    protected StudentService $studentService;
    protected CourseService $courseService;

    public function boot(AssesmentService $assesmentService, StudentService $studentService, CourseService $courseService)
    {
        $this->assesmentService = $assesmentService;
        $this->studentService = $studentService;
        $this->courseService = $courseService;
    }

    public function mount($id)
    {
        $this->id = (int)$id;
        $this->assesment = $this->assesmentService->getById($id);
        $this->student_id = $this->assesment->student_id;
        $this->course_id = $this->assesment->course_id;
        $this->types = $this->assesment->types;
        $this->scores = $this->assesment->scores;
    }

    public function render()
    {
        return view('livewire.assesment.edit', [
            'students' => $this->studentService->getAll(),
            'courses' => $this->courseService->getAll(),
            'assessmentTypes' => AssesmentType::toArray()
        ]);
    }

    public function update()
    {
        $this->validate();
        try {
            $result = $this->assesmentService->update($this->id, $this->all());
            if (!$result) {
                session()->flash('error', 'Something went wrong.');
                return redirect()->route('assesment.index');
            }
    
            session()->flash('message', 'Assesment updated successfully.');
            return redirect()->route('assesment.index');
        } catch(\App\Exceptions\NotFoundException) {
            session()->flash('error', 'Assesment not found.');
            return redirect()->route('assesment.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'Something went wrong.');
            return redirect()->route('assesment.index');
        }
    }
}