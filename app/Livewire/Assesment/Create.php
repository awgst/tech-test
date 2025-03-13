<?php

namespace App\Livewire\Assesment;

use App\Constants\AssesmentType;
use App\Models\Assesment\Essay;
use App\Models\Assesment\Exam;
use App\Models\Assesment\Quiz;
use App\Services\Assesment\AssesmentService;
use App\Services\Course\CourseService;
use App\Services\Student\StudentService;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
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

    public function render()
    {
        return view('livewire.assesment.create', [
            'students' => $this->studentService->getAll(),
            'courses' => $this->courseService->getAll(),
            'assessmentTypes' => AssesmentType::toArray()
        ]);
    }

    public function save()
    {
        $this->validate();
        try {
            $result = $this->assesmentService->create($this->createAssesmentObject($this->types, $this->all()));
            if (!$result) {
                session()->flash('error', 'Something went wrong.');
                return redirect()->route('assesment.index');
            }
    
            session()->flash('message', 'Assesment created successfully.');
            return redirect()->route('assesment.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', $e->getCode() == 400 ? $e->getMessage() : 'Something went wrong.');
            return redirect()->route('assesment.index');
        }
    }

    public function createAssesmentObject($type, $data) 
    {
        switch ($type) {
            case AssesmentType::QUIZ:
                return (new Quiz())->fill($data);
                break;
            case AssesmentType::EXAM:
                return (new Exam())->fill($data);
                break;
            case AssesmentType::ESSAY:
                return (new Essay())->fill($data);
                break;
            default:
                throw new \Exception('invalid type', 400);
                break;
        }
    }
}