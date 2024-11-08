<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'todo_list_id' => TodoList::factory(),
            'status' => $this->faker->randomElement([Task::PRIVATE, Task::PUBLIC, Task::CANCELLED, Task::COMPLETED])
        ];
    }
}
