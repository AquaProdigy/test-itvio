<?php

new class extends \Livewire\Volt\Component
{
    public string $name = '';
    public int $todoListId;
    public string $status = '';

    public function mount(int $todoListId)
    {
        $this->todoListId = $todoListId;
    }

    public function createTask()
    {

        $validated = $this->validate([
            'name' => ['required', 'max:255', 'string'],
            'status' => ['required', 'in:cancelled,confirmed,public,private'],
        ]);

        $validated['todo_list_id'] = $this->todoListId;
        \App\Models\Task::create($validated);

        $this->name = '';
        $this->dispatch('taskCreated');
    }


}
?>

<div>
    Create task
    <form wire:submit.prevent="createTask" class="flex flex-col">
        <input type="text" wire:model="name" class="text-black">
        <select wire:model="status" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="public">Public</option>
            <option value="private">Private</option>
            <option value="completed">Completed</option>
            <option value="cancelled">Cancelled</option>
        </select>
        <button type="submit">Create</button>
    </form>
</div>
