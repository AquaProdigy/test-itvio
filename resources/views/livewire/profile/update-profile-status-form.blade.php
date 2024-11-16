<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public string $profile_status = '';



    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->profile_status = Auth::user()->profile_status;
    }

    public function updateProfileStatus(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'profile_status' => ['required', 'in:private,public']
        ]);

        $user->update([
            'profile_status' => $validated['profile_status']
        ]);
        $this->dispatch('profile-updated', name: $user->name);


    }


}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile status') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your profile status") }}
        </p>
    </header>

    <form wire:submit="updateProfileStatus" class="mt-6 space-y-6">
        <select name="status" wire:model.live="profile_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="public">Public</option>
            <option value="private">Private</option>
        </select>

        <x-primary-button>{{ __('Save') }}</x-primary-button>
        <x-action-message class="me-3" on="profile-updated">
            {{ __('Saved.') }}
        </x-action-message>
    </form>



</section>

