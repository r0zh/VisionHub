<div class="flex flex-col gap-y-6">
    
    <x-filament-panels::form
        id="form"
        :wire:key="$this->getId() . '.forms.' . $this->getFormStatePath()"
        wire:submit="fetch"
    >
        {{ $this->form }}

        <x-filament::button type="submit">
            New Image
        </x-filament::button>
    </x-filament-panels::form>
    
</div>
