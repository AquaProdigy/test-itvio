<?php

namespace App\Livewire;

use App\Models\TodoList;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class TodoRowComponent extends Component
{
    public $todo;
    public $newStatus;
    public $newName;

    public function mount($todo)
    {

        $this->todo = $todo;
        $this->newName = $todo->name;
        $this->newStatus = $todo->status;
    }

    public function delete()
    {
        $this->todo->delete();
        $this->dispatch('delete', id: $this->todo->id);
    }

    public function updateName()
    {
        $this->validate([
            'newName' => 'required|string'
        ]);

        if($this->newName !== $this->todo->name) {
            $this->todo->name = $this->newName;
            $this->todo->save();
        }
    }
    public function updateStatus()
    {

        $todo = TodoList::find($this->todo->id);
        $todo->status = $this->newStatus;
        $todo->save();
    }

    public function render()
    {
        return view('livewire.todo-row-component');
    }
}
