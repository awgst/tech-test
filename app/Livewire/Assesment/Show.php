<?php

namespace App\Livewire\Assesment;

use App\Services\Assesment\AssesmentService;
use Livewire\Component;

class Show extends Component
{
    public $assesment;

    public function mount($id)
    {
        $this->assesment = app(AssesmentService::class)->getById($id);
    }

    public function render()
    {
        if (!$this->assesment) {
            abort(404);
        }
        
        return view('livewire.assesment.show');
    }
}