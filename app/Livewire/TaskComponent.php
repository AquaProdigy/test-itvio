<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\TodoList;
use Livewire\Attributes\On;
use Livewire\Component;

class TaskComponent extends Component
{


    public $todoList;

    public function mount($id)
    {
        $this->todoList = TodoList::find($id);
    }

//    #[On('deleteTask')]
    public function delete(Task $task)
    {
        $task->delete();

    }

    #[On('create')]
    public function create(string $name, string $status)
    {

        Task::create([
            'name' => $name,
            'status' => $status,
            'todo_list_id' => $this->todoList->id
        ]);


    }

    public function render()
    {

        if (\Auth::user()?->id === $this->todoList?->user_id) {
            $tasks = TodoList::findOrFail($this->todoList?->id)
                ->tasks()
                ->orderBy('created_at', 'desc')
                ->get();

        } else {
            $tasks = TodoList::findOrFail($this->todoList?->id)
                ->tasks()
                ->whereIn('status', ['public', 'completed', 'cancelled'])
                ->orderBy('created_at', 'desc')
                ->get();
        }


        if (\Auth::user()) {
            return view(
                'livewire.task-component',
                ['tasks' => $tasks])
                ->layout('layouts.app');
        }
        return view(
            'livewire.task-component',
            ['tasks' => $tasks]);
    }
}
