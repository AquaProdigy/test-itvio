<?php


use App\Livewire\TodoComponent;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('todo', TodoComponent::class)
    ->middleware(['auth'])
    ->name('todo');

Route::prefix('todo')->group(function () {
    Route::get('/{id}', \App\Livewire\TaskComponent::class)->name('todo.show');
});



require __DIR__.'/auth.php';
