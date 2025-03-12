<?php

namespace App\Livewire\Course;

use App\Models\Course;
use App\Services\Course\CourseService;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Create extends Component
{
    public $name;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    protected CourseService $courseService;

    public function boot(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function render()
    {
        return view('livewire.course.create');
    }

    public function save()
    {
        $this->validate();
        try {
            $id = $this->courseService->create([
                'name' => $this->name,
            ]);
            if ($id === 0) {
                return redirect()->route('course.index')->with('error', 'Something went wrong.');
            }

            session()->flash('message', 'Course created successfully.');
            return redirect()->route('course.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}