<div class="py-12">
    <div class="text-2xl dark:text-white flex justify-center">
        Todos
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mb-4">
        <livewire:todo-create-component />
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @foreach($todos as $todo)
            <livewire:todo-row-component :todo="$todo" :key="'todo' . $todo->id"/>
        @endforeach

    </div>
</div>
