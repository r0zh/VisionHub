<div class="flex flex-col gap-y-6">
    <form wire:submit="create">
        {{ $this->form }}

        <x-filament::button type="submit">
            New Image
        </x-filament::button>
    </form>

    <x-filament-actions::modals />
</div>
