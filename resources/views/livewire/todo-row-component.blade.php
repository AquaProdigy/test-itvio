
<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <div class="dark:text-white grid grid-cols-3 ">
        <div x-data="{showEdit: false}">
            <div x-show="!showEdit" class="flex flex-col gap-y-1.5">
                <div>
                    <a
                        href="{{ route('todo.show', $todo->id) }}"
                        class="dark:hover:text-white/70 text-xl">
                        {{ str($todo->name)->limit(20) }}
                    </a>
                </div>
                <div>
                    @if(Auth::user()?->id === $todo->user_id)
                        <x-primary-button @click="showEdit = !showEdit" class="max-w-24">Edit</x-primary-button>
                    @endif
                </div>
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
        </div>
        <div class="flex justify-self-center gap-x-3 items-center">
            Status
            <select wire:model="newStatus" class="text-black rounded-full">
                <option value="public">Public</option>
                <option value="private">Private</option>
            </select>
            <x-primary-button
                type="button"
                class="max-h-8"
                wire:confirm="Are you sure for update Status?"
                wire:click.prevent="updateStatus">
                Save
            </x-primary-button>
        </div>
        <div class="flex justify-self-center items-center">
            <x-danger-button
                wire:click.prevent="delete"
                class="max-h-8"
                wire:confirm="Are you sure for delete this Todo list?">
                Delete
            </x-danger-button>
        </div>
    </div>
</div>
