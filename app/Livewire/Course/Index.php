<?php

namespace App\Livewire\Course;

use App\Models\Course;
use App\Services\Course\CourseService;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Index extends Component
{
    protected CourseService $courseService;

    public function boot(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function render()
    {
        try {
            $courses = $this->courseService->getAll();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'Something went wrong.');
        } finally {
            return view('livewire.course.index', compact('courses'));
        }
    }

    public function delete($id)
    {
        try {
            $this->courseService->delete($id);
        } catch(\App\Exceptions\NotFoundException $e) {
            session()->flash('error', "Course not found");
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'Something went wrong.');
        } finally {
            session()->flash('message', 'Course deleted successfully.');
        }
    }
}