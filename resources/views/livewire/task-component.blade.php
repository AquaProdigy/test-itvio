<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-4">
    <div class="text-2xl dark:text-white flex justify-center">
        Tasks
    </div>
    @if(Auth::user()?->id === $todoList->user_id)
        <div>
            <livewire:task-create-component />
        </div>
    @endif
    <div>
        @if ($todoList->status === \App\Models\TodoList::PUBLIC || Auth::user()?->id === $todoList->user_id)
            @foreach($tasks as $task)
                <livewire:task-list-component :task="$task" :todoList="$todoList"  :key="'task' . $task->id . $task->name"/>
            @endforeach

        @else
            <div class="dark:text-white flex justify-center text-2xl justify-self-center ">
                This Tasks list is private
            </div>
        @endif
    </div>

</div>
