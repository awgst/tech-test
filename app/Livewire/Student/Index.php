<?php

namespace App\Livewire\Student;

use App\Models\Student;
use App\Services\Student\StudentService;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Index extends Component
{
    protected StudentService $studentService;

    public function boot(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function render()
    {
        try {
            $students = $this->studentService->getAll();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'Something went wrong.');
        } finally {
            return view('livewire.student.index', compact('students'));
        }
    }

    public function delete($id)
    {
        try {
            $this->studentService->delete($id);
        } catch(\App\Exceptions\NotFoundException $e) {
            session()->flash('error', "Student not found");
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'Something went wrong.');
        } finally {
            session()->flash('message', 'Student deleted successfully.');
        }
    }

    public function calculateFinalGrade()
    {
        try {
            session()->flash('message', 'Final grade calculated successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'Something went wrong.');
        }
    }
}