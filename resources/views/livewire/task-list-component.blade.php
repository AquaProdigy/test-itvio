<div x-data="{showEdit: false}" class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg grid grid-cols-3 mb-4 items-center">
    <div x-show="!showEdit" class="flex flex-col gap-y-1.5">
        <p class="text-xl dark:text-white">
            {{ $task->name }}
        </p>
        @if(Auth::user()?->id === $todoList->user_id)
        <x-primary-button @click="showEdit = !showEdit" class="max-w-24">Edit</x-primary-button>
        @endif
    </div>
    <div x-show="showEdit" class="flex flex-col gap-y-1.5">
        <input type="text" wire:model="newName" class="text-black max-h-8 rounded-full">
        <x-primary-button
            @click="showEdit = !showEdit"
            class="max-w-24"
            wire:click.prevent="updateName">
            Save
        </x-primary-button>
    </div>
    <div class="max-w-xl dark:text-white flex justify-self-center items-center gap-x-3">

        @if(Auth::user()?->id === $todoList->user_id)
            Status:
            <select wire:model="newStatus" class="text-black rounded-full">
                <option value="public">Public</option>
                <option value="private">Private</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
            <x-primary-button wire:click.prevent="updateStatus" wire:confirm="Are you sure for update status?">Save</x-primary-button>
        @else
            Status: {{ $task->status }}
        @endif

    </div>
    <div class="flex justify-self-center">
        @if(Auth::user()?->id === $todoList->user_id)
            <x-danger-button wire:click.prevent="$parent.delete({{$task->id}})">Delete</x-danger-button>
        @endif
    </div>

</div>



