<?php


use App\Livewire\TodoListShow;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('todo', 'todo')
    ->middleware(['auth'])
    ->name('todo');


Route::middleware(['auth'])->group(function () {
    Route::get('todo/{id}', TodoListShow::class)->name('todo.show');
});



require __DIR__.'/auth.php';
