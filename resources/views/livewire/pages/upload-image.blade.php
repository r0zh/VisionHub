<div class="flex flex-col gap-y-6 2xl:mx-96">
    <form wire:submit="create">
        {{ $this->form }}

        <div class="flex w-full items-center justify-center mt-4 gap-2">
            <x-filament::button type="submit">
                {{ __('Create') }}
            </x-filament::button>
            <x-filament::button type="button" wire:click="resetForm" color="danger">
                {{ __('Reset') }}
            </x-filament::button>
        </div>

    </form>

    <x-filament-actions::modals />
</div>
