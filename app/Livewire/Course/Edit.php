<?php

namespace App\Livewire\Course;

use App\Services\Course\CourseService;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Edit extends Component
{
    public $id;
    protected $course;
    public $name;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    protected CourseService $courseService;

    public function boot(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function mount($id)
    {
        $this->id = (int)$id;
        $this->course = $this->courseService->getById($id);
        $this->name = $this->course->name;
    }

    public function render()
    {
        return view('livewire.course.edit');
    }

    public function update()
    {
        $this->validate();
        try {
            $result = $this->courseService->update($this->id, $this->all());
            if (!$result) {
                session()->flash('error', 'Something went wrong.');
                return redirect()->route('course.index');
            }
    
            session()->flash('message', 'Course updated successfully.');
            return redirect()->route('course.index');
        } catch(\App\Exceptions\NotFoundException) {
            session()->flash('error', 'Course not found.');
            return redirect()->route('course.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'Something went wrong.');
            return redirect()->route('course.index');
        }
    }
}