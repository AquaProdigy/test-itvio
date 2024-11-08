<?php

new class extends \Livewire\Volt\Component
{
    public \Illuminate\Database\Eloquent\Collection $todoLists;
    public array $statuses = [];

    public function mount()
    {
        $this->todoLists = Auth::user()->todoLists()->get();

        foreach ($this->todoLists as $list) {
            $this->statuses[$list->id] = $list->status;
        }
    }

    public function updateStatus(int $id)
    {

        \App\Models\TodoList::find($id)->update([
            'status' => $this->statuses[$id]
        ]);
    }
} ?>

<section>
    <p class="text-white text-4xl mb-4">Todo Lists</p>
    @foreach($todoLists as $list)

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-4 text-white flex justify-between">
                <a href="{{ route('todo.show', $list['id']) }}">
                    <div class="max-w-xl">
                        {{ $list['name'] }}
                    </div>
                </a>
                <div>
                    Publicity status:
                    <select wire:model="statuses.{{ $list->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="public">Public</option>
                        <option value="private">Private</option>
                    </select>
                    <button wire:click.prevent="updateStatus({{ $list->id }})">Save</button>
                </div>
            </div>

    @endforeach
</section>

