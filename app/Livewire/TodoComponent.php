<?php

namespace App\Livewire;


use App\Models\TodoList;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.app')]
class TodoComponent extends Component
{
    public \Illuminate\Support\Collection $todos;


    public function mount()
    {
        $this->todos = \Auth::user()->todoLists()->orderBy('created_at', 'desc')->get();
    }

    #[On('delete')]
    public function renderDelete($id)
    {
        $this->todos->forget($id);
    }

    #[On('store')]
    public function renderCreate(string $name, string $status)
    {
        $todo_list = TodoList::create([
            'name' => $name,
            'status' => $status,
            'user_id' => \Auth::user()->id
        ]);
        $this->todos->prepend($todo_list);
    }

    public function render()
    {
        return view('todo-component');
    }
}
