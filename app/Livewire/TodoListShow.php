<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TodoListShow extends Component
{
    public $todoList;
    public $tasks;
    public $status;
    public $statuses = [];
    public $taskNames = [];
    public $accessDenied = false;

    public function mount(int $id)
    {
        $this->todoList = TodoList::with('tasks')->findOrFail($id);


        if ($this->todoList->status === 'private' && $this->todoList->user_id !== Auth::id()) {
            $this->accessDenied = true;
        } else {

            $this->tasks = $this->todoList->tasks;


            foreach ($this->tasks as $task) {
                $this->statuses[$task->id] = $task->status;
                $this->taskNames[$task->id] = $task->name;
            }
        }
    }


    public function refreshTasks()
    {

        $this->mount($this->todoList->id);
    }


    public function deleteTask(int $id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->delete();
        }


        $this->refreshTasks();
    }


    public function updateStatus($taskId)
    {
        $task = Task::find($taskId);
        if ($task) {
            $task->status = $this->statuses[$taskId];
            $task->save();
        }
    }

    public function updateNameTask(int $taskId, string $name)
    {
        $task = Task::find($taskId);
        $task->name = $name;
        $task->save();
        $this->refreshTasks();
    }
    public function render()
    {
        $layout = $this->accessDenied ? 'layouts.guest' : 'layouts.app';
        return view('livewire.todo.todo-list-show', [
            'accessDenied' => $this->accessDenied
        ])->layout($layout);
    }


    protected $listeners = [
        'taskCreated' => 'refreshTasks',
    ];
}
