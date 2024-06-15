<x-filament::modal id="image-info-modal" width="7xl" alignment="center">
    <x-slot name="header">Edit Image</x-slot>
    <div>
        <div class="grid grid-cols-2 gap-3 p-4 rounded-xl shadow-lg w-full">
            <div class="w-fit">
                <img src="@if ($image->public == 1) {{ asset('storage/' . $image->path) }} @else {{ url($image->path) }} @endif"
                    alt="{{ $image->positivePrompt }}" class="w-fit max-h-[80vh]" />
            </div>
            <div class="p-2">
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
            <x-filament::button wire:click='togglePublic' color="{{ $image->public ? 'danger' : 'warning' }}">
                {{ $image->public ? 'Make Private' : 'Make Public' }}
            </x-filament::button>
        @endif
        @if ($image->user->id == auth()->id() || auth()->user()->hasRole('admin'))
            <x-filament::button wire:click='deleteImage' color="danger">
                Delete
            </x-filament::button>
        @endif

    </x-slot>
</x-filament::modal>
