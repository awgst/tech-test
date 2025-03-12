<?php

namespace App\Livewire\Student;

use App\Services\Student\StudentService;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Edit extends Component
{
    public $id;
    protected $student;
    public $name;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    protected StudentService $studentService;

    public function boot(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function mount($id)
    {
        $this->id = (int)$id;
        $this->student = $this->studentService->getById($id);
        $this->name = $this->student->name;
    }

    public function render()
    {
        return view('livewire.student.edit');
    }

    public function update()
    {
        $this->validate();
        try {
            $result = $this->studentService->update($this->id, $this->all());
            if (!$result) {
                session()->flash('error', 'Something went wrong.');
                return redirect()->route('student.index');
            }
    
            session()->flash('message', 'Student updated successfully.');
            return redirect()->route('student.index');
        } catch(\App\Exceptions\NotFoundException) {
            session()->flash('error', 'Student not found.');
            return redirect()->route('student.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'Something went wrong.');
            return redirect()->route('student.index');
        }
    }
}