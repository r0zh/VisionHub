<x-filament::modal slide-over>
    <x-slot name="trigger">
        Admin Views
    </x-slot>

    <div>
        <p href="/admin/images" wire:navigate class="cursor-pointer text-lg">
            Images
        </p>
        <p href="/admin/tags" wire:navigate class="cursor-pointer text-lg">
            Tags
        </p>
        <p href="/admin/users" wire:navigate class="cursor-pointer text-lg">
            Users
        </p>
        <p href="/admin/loras" wire:navigate class="cursor-pointer text-lg">
            Loras
        </p>
        <p href="/admin/checkpoints" wire:navigate class="cursor-pointer text-lg">
            Checkpoints
        </p>
    </div>
</x-filament::modal>
