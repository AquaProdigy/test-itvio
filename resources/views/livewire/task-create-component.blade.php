<div>
    <input wire:model="name" type="text" placeholder="Name for task...">
    <select wire:model="status">
        <option value="public">Public</option>
        <option value="private">Private</option>
        <option value="completed">Completed</option>
        <option value="cancelled">Cancelled</option>
    </select>
    <x-primary-button wire:click.prevent="sendEventCreate">Create</x-primary-button>
</div>
