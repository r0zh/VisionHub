<form wire:submit="updateSearch">
    <input type="text" placeholder="Search by positive prompt..."
        class="rounded dark:text-white dark:bg-gray-700 md:min-w-96" wire:model="search" wire:keydown.enter="updateSearch">
</form>