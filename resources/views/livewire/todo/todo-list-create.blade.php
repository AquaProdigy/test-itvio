<?php


new class extends \Livewire\Volt\Component
{
    public string $name = '';
    public string $status = 'private';

    public function createTodoList()
    {
        $validated = $this->validate([
            'name' => ['required'],
            'status' => ['required', 'in:public,private']
        ]);
        $validated['user_id'] = Auth::user()->id;
        $todo_list = \App\Models\TodoList::create($validated);

        $this->name = '';

        $this->dispatch('update-todo-list');
    }
}
?>


<section>
    <form wire:submit="createTodoList()">
        <input type="text" placeholder="Name todo list" wire:model="name">
        <x-primary-button>Create</x-primary-button>
    </form>

</section>
