<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\TodoList;
use Livewire\Component;

class TaskListComponent extends Component
{
    public Task $task;
    public $newStatus;
    public $todoList;
    public $newName;

    function mount(Task $task, TodoList $todoList)
    {
        $this->task = $task;
        $this->newName = $task->name;
        $this->todoList = $todoList;
        $this->newStatus = $task->status;
    }

    public function updateStatus()
    {

        $this->task->status = $this->newStatus;
        $this->task->save();
    }

    public function updateName()
    {
        $this->validate([
            'newName' => 'required|string'
        ]);

        if($this->newName !== $this->task->name) {
            $this->task->name = $this->newName;
            $this->task->save();
        }

    }
    public function render()
    {
        return view('livewire.task-list-component');
    }
}
