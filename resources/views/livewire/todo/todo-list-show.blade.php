<section class="max-w-4xl">
    <div>
        @if($accessDenied)
            <div class="alert alert-danger text-white">
                <p>You do not have permission to view this private todo list.</p>
            </div>
        @elseif($todoList)
            <div class="text-white">
                <div class="mb-4">
                    <h1 class="text-2xl">Name list: {{ $todoList->name }}</h1>
                    <p>Status: {{ ucfirst($todoList->status) }}</p>
                    <div>
                        @if ($todoList->status === 'private')
                            <p class="text-red-500">This list is private.</p>
                        @else
                            <p class="text-green-500">This list is public. Share the link to this page.</p>
                        @endif
                    </div>
                    <div>
                        @if($todoList->user_id === Auth::id())
                            <livewire:todo.task-create-form :todoListId="$todoList->id" />
                        @endif
                    </div>
                </div>

                <h2 class="text-xl mt-4">Tasks:</h2>
                <ul>
                    @foreach($tasks as $task)

                        @if ($todoList->user_id === Auth::id() || $task->status !== 'private')
                            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg mb-4 text-white flex justify-between">
                                <div class="max-w-xl">
                                    @if($todoList->status === 'public' && $todoList->user_id !== Auth::id())
                                        <span>{{ $task->name }}</span>
                                    @else
                                        <input type="text" wire:model="taskNames.{{ $task->id }}" value="{{ $task->name }}" class="text-black">
                                        <button wire:click.prevent="updateNameTask({{ $task->id }}, '{{ $taskNames[$task->id] }}')">Save</button>
                                    @endif
                                </div>
                                <div>
                                    @if($todoList->user_id === Auth::id())
                                        Publicity status:
                                        <select wire:model="statuses.{{ $task->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="public">Public</option>
                                            <option value="private">Private</option>
                                            <option value="completed">Completed</option>
                                            <option value="cancelled">Cancelled</option>
                                        </select>

                                        <button wire:click.prevent="updateStatus({{ $task->id }}, '{{ $statuses[$task->id] }}')">Save</button>
                                    @else
                                        <p>Status: {{ ucfirst($task->status) }}</p>
                                    @endif
                                </div>
                                @if($todoList->status === 'public' && $todoList->user_id === Auth::id())
                                    <div>
                                        <button wire:click.prevent="deleteTask({{ $task->id }})">Delete</button>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </ul>
            </div>
        @else
            <p>You do not have permission to view this list.</p>
        @endif
    </div>
</section>
