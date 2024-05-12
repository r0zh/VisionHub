<div class="flex flex-col gap-y-6">
    


    <x-filament-panels::form
        id="form"
        :wire:key="$this->getId() . '.forms.' . $this->getFormStatePath()"
        wire:submit="create"
    >
        {{ $this->form }}

        
    </x-filament-panels::form>
</div>
