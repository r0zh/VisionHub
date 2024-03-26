    <div class="grid relative grid-cols-2 gap-3 p-4 bg-white rounded-xl shadow-lg">
        <div class="w-fit">
            <img src="@if ($image->public == 1) {{ asset('storage/' . $image->path) }} @else {{ url($image->path) }} @endif"
                alt="{{ $image->positivePrompt }}" class="w-fit max-h-[80vh]">
        </div>
        <div class="relative p-2">
            <h1 class="text-3xl font-bold">Seed</h1>
            <p>{{ $image->seed }}</p>
            <h1 class="text-3xl font-bold">Positive Prompt</h1>
            <p>{{ $image->positivePrompt }}</p>
            <h1 class="text-3xl font-bold">NegativePrompt</h1>
            @if($image->negativePrompt)
            <p>{{ $image->negativePrompt }}</p>
            @else
            <p>No negative prompt</p>
            @endif
            <h1 class="text-3xl font-bold">User</h1>
            <p>{{ $image->user()->name }}</p>
            <h1 class="text-3xl font-bold">Style</h1>
            <p>{{ $image->style }}</p>
            <h1 class="text-3xl font-bold"> Created At</h1>
            <p>{{ $dateCreated }}</p>
            @if ($image->user()->id == auth()->id() || auth()->user()->hasRole('moderator') || auth()->user()->hasRole('admin'))
                <div class="flex absolute bottom-0 left-0 justify-end">
                    <!-- togle public -->
                    <button
                        class="py-2 px-4 text-white  {{ $image->public ? 'bg-purple-600' : 'bg-blue-500' }} rounded-md"
                        wire:click="togglePublic({{ $image->id }})">
                        {{ $image->public ? 'Make Private' : 'Make Public' }}
                    </button>
                </div>
            @endif
            @if ($image->user()->id == auth()->id() || auth()->user()->hasRole('admin'))
                <div class="flex absolute right-0 bottom-0 justify-end">
                    <button class="py-2 px-4 text-white bg-red-500 rounded-md"
                        wire:click="deleteImage({{ $image->id }})">Delete</button>
                </div>
            @endif

        </div>
        <svg class="absolute top-0 right-0 p-2 w-12 cursor-pointer" fill="#000000" viewBox="0 0 32 32"
            xmlns="http://www.w3.org/2000/svg" wire:click="$dispatch('closeModal')">
            <path
                d="M18.8,16l5.5-5.5c0.8-0.8,0.8-2,0-2.8l0,0C24,7.3,23.5,7,23,7c-0.5,0-1,0.2-1.4,0.6L16,13.2l-5.5-5.5  c-0.8-0.8-2.1-0.8-2.8,0C7.3,8,7,8.5,7,9.1s0.2,1,0.6,1.4l5.5,5.5l-5.5,5.5C7.3,21.9,7,22.4,7,23c0,0.5,0.2,1,0.6,1.4  C8,24.8,8.5,25,9,25c0.5,0,1-0.2,1.4-0.6l5.5-5.5l5.5,5.5c0.8,0.8,2.1,0.8,2.8,0c0.8-0.8,0.8-2.1,0-2.8L18.8,16z" />
        </svg>
    </div>
