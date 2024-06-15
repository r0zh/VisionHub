<x-filament::modal id="image-info-modal" width="7xl" alignment="center" class="dark:text-white">

    <div>
        <div class="grid grid-cols-2 gap-3 p-4  w-full">
            <div class="w-fit grid-column-span-2">
                <img src="@if ($image->public == 1) {{ asset('storage/' . $image->path) }} @else {{ url($image->path) }} @endif"
                    alt="{{ $image->positivePrompt }}" class="w-fit max-h-[80vh] rounded-xl shadow-lg" />
            </div>
            <div class="p-2">
                @if ($this->image->name)
                    <h1 class="text-3xl font-bold">Name</h1>
                    <p>{{ $image->name }}</p>
                @endif
                @if ($this->image->description)
                    <h1 class="text-3xl font-bold">Description</h1>
                    <p>{{ $image->description }}</p>
                @endif
                <h1 class="text-3xl font-bold">Seed</h1>
                <p>{{ $image->seed }}</p>
                <h1 class="text-3xl font-bold">Positive Prompt</h1>
                <p>{{ $image->positivePrompt }}</p>
                <h1 class="text-3xl font-bold">NegativePrompt</h1>
                @if ($image->negativePrompt)
                    <p>{{ $image->negativePrompt }}</p>
                @else
                    <p>No negative prompt</p>
                @endif
                <h1 class="text-3xl font-bold">User</h1>
                <p>{{ $image->user->name }}</p>
                <h1 class="text-3xl font-bold">Style</h1>
                {{-- <p>{{ $image->style->name }}</p> --}}
                <h1 class="text-3xl font-bold">Created At</h1>
                <p>{{ $dateCreated }}</p>

            </div>
        </div>
    </div>
    <x-slot name="footerActions">
        @if ($image->user->id == auth()->id() || auth()->user()->hasRole('moderator') || auth()->user()->hasRole('admin'))
            <x-filament::button wire:click='togglePublic' color="{{ $image->public ? 'gray' : 'info' }}"
                icon="{{ $image->public ? 'heroicon-o-lock-closed' : 'heroicon-o-lock-open' }}">
                {{ $image->public ? 'Make Private' : 'Make Public' }}
            </x-filament::button>
        @endif
        @if ($image->user->id == auth()->id() || auth()->user()->hasRole('admin'))
            <x-filament::button wire:click='deleteImage' color="danger" icon="heroicon-o-trash">
                Delete
            </x-filament::button>
        @endif

    </x-slot>
</x-filament::modal>
