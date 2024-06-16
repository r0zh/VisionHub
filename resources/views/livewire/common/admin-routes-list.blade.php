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
        @if (auth()->user()->hasRole('admin'))
            <p href="/admin/users" wire:navigate class="cursor-pointer text-lg">
                Users
            </p>
        @endif
        <p href="/admin/three-d-models" wire:navigate class="cursor-pointer text-lg">
            3D Models
        </p>
        <p href="/admin/loras" wire:navigate class="cursor-pointer text-lg">
            Loras
        </p>
        <p href="/admin/checkpoints" wire:navigate class="cursor-pointer text-lg">
            Checkpoints
        </p>
    </div>
</x-filament::modal>
