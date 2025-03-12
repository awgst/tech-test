<?php

namespace App\Livewire\Student;

use App\Models\Student;
use App\Services\Student\StudentService;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Create extends Component
{
    public $name;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    protected StudentService $studentService;

    public function boot(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function render()
    {
        return view('livewire.student.create');
    }

    public function save()
    {
        $this->validate();
        try {
            $student = new Student([
                'name' => $this->name,
            ]);
    
            $id = $this->studentService->create($student);
            if ($id === 0) {
                return redirect()->route('student.index')->with('error', 'Something went wrong.');
            }

            session()->flash('message', 'Student created successfully.');
            return redirect()->route('student.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}