<?php

namespace App\Livewire\Assesment;

use App\Services\Assesment\AssesmentService;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Index extends Component
{
    protected AssesmentService $assesmentService;

    public function boot(AssesmentService $assesmentService)
    {
        $this->assesmentService = $assesmentService;
    }

    public function render()
    {
        try {
            $assesments = $this->assesmentService->getAll();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'Something went wrong.');
        } finally {
            return view('livewire.assesment.index', compact('assesments'));
        }
    }

    public function delete($id)
    {
        try {
            $this->assesmentService->delete($id);
        } catch(\App\Exceptions\NotFoundException $e) {
            session()->flash('error', "Assesment not found");
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', 'Something went wrong.');
        } finally {
            session()->flash('message', 'Assesment deleted successfully.');
        }
    }
}