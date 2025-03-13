<?php

namespace App\Livewire\CountChar;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Index extends Component
{
    public $input1;
    public $input2;

    public function render()
    {
        return view('livewire.count-char.index');
    }

    public function process()
    {
        $i1 = strtolower($this->input1);
        $i2 = strtolower($this->input2);

        $i1Char = [];

        for ($i = 0; $i < strlen($i1); $i++) {
            if (!array_key_exists($i1[$i], $i1Char)) {
                $i1Char[$i1[$i]] = true;
            }
        }

        $totalAppearance = 0;
        for ($i = 0; $i < strlen($i2); $i++) {
            if (array_key_exists($i2[$i], $i1Char)) {
                $totalAppearance++;
                unset($i1Char[$i2[$i]]);
            }
        }

        if ($totalAppearance == 0) {
            session()->flash('message', 'No match found.');
            return;
        }
        $result = (($totalAppearance/strlen($i1))*100).'%';
        session()->flash('message', $result);
    }
}