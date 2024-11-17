<?php

namespace App\Livewire;

use Livewire\Component;

class TaskCreateComponent extends Component
{
    public string $name = '';
    public string $status = 'public';

    public function sendEventCreate()
    {
        $this->validate([
            'name' => 'required',
            'status' => 'required'
        ]);

        $this->dispatch('create', name: $this->name, status: $this->status);
        $this->reset('name', 'status');
    }

    public function render()
    {

        return view('livewire.task-create-component');
    }
}
