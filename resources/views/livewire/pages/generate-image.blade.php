<div>
    <style>
        .submitButton {
            border-radius: 0rem 0rem 0.5rem 0.5rem;
        }

        .fi-section {
            border-radius: 0.5rem 0.5rem 0rem 0rem;
        }
    </style>
    <div
        class="@if ($this->fetching || $this->imagePath) xl:flex xl:flex-row md:mx-20  @else 2xl:mx-96 @endif transition-all items-center justify-center gap-16">
        <form wire:submit="create"
            class="transition-all flex justify-center flex-col @if ($this->fetching || $this->imagePath) w-full @endif">
            {{ $this->form }}

            <x-filament::button class="submitButton" wire:click="create">
                {{ __('Submit') }}
            </x-filament::button>
        </form>

        <div class="flex justify-center items-center flex-col w-full gap-y-2 mt-10 md:mx-2">
            @if (!$this->fetching && $this->imagePath)
                <div class="flex justify-center items-center rounded-lg">
                    <img src="{{ asset('storage/' . $this->imagePath) }}" alt="image"
                        class="h-auto w-full md:w-[600px] rounded-xl max-w-[70%]">
                </div>
                <div class="flex justify-between items-center">
                    {{ $this->saveImageAction() }}
                </div>
            @endif
        </div>

    </div>
    <x-filament-actions::modals />
</div>
