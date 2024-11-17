<?php

namespace App\Livewire;

use Livewire\Component;

class TodoCreateComponent extends Component
{
    public string $name = '';
    public string $status = 'public';

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'status' => 'required'
        ]);
        $this->dispatch('store', name: $this->name, status: $this->status);
        $this->reset('name', 'status');
    }

    public function render()
    {
        return view('livewire.todo-create-component');
    }
}
