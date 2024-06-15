<x-filament::modal id="image-info-modal" width="fit" alignment="center" class="dark:text-white">
    <div>
        <div class="xl:grid xl:grid-cols-2 gap-3 p-4 w-fit">
            <div class="flex justify-center items-center">
                <div class="w-fit h-fit">
                    <img src="@if ($image->public == 1) {{ asset('storage/' . $image->path) }} @else {{ url($image->path) }} @endif"
                        alt="{{ $image->positivePrompt }}" class="xl:w-fit xl_max-h-[80vh] rounded-xl shadow-lg" />
                    <h1 class="text-xl font-bold">By {{ $image->user->name }}</h1>
                </div>
            </div>
            <div class="p-2">
                @if ($this->image->name)
                    <h1 class="text-3xl font-bold">Name</h1>
                    <p>{{ $image->name }}</p>
                @endif
                @if ($this->image->description)
                    <h1 class="text-3xl font-bold mt-1 mt-1">Description</h1>
                    <p class="break-all">{{ $image->description }}</p>
                @endif
                <h1 class="text-3xl font-bold mt-1">Positive Prompt</h1>
                <p>{{ $image->positivePrompt }}</p>
                @if ($image->negativePrompt)
                    <h1 class="text-3xl font-bold mt-1">NegativePrompt</h1>
                    <p>{{ $image->negativePrompt }}</p>
                @endif
                @if ($this->image->checkpoint)
                    <h1 class="text-3xl font-bold mt-1">Checkpoint</h1>
                    <p>{{ $image->checkpoint->name }}</p>
                @endif
                <h1 class="text-3xl font-bold mt-1">Seed</h1>
                <p>{{ $image->seed }}</p>
                <br>
                @if ($image->loras)
                    <x-zeus-accordion::accordion activeAccordion="0">
                        <x-zeus-accordion::accordion.item :label="'Loras'">
                            <ul class="list-disc ml-3">
                                @for ($i = 0; $i < count($image->loras); $i++)
                                    <li>{{ $image->loras[$i]->name }}</li>
                                @endfor
                            </ul>
                        </x-zeus-accordion::accordion.item>
                    </x-zeus-accordion::accordion>
                @endif
                @if ($image->embeddings)
                    <x-zeus-accordion::accordion activeAccordion="0">
                        <x-zeus-accordion::accordion.item :label="'Embeddings'">
                            <ul class="list-disc ml-3">
                                @for ($i = 0; $i < count($image->embeddings); $i++)
                                    <li>{{ $image->embeddings[$i]->name }}</li>
                                @endfor
                            </ul>
                        </x-zeus-accordion::accordion.item>
                    </x-zeus-accordion::accordion>
                @endif
                @if ($image->tags)
                    <x-zeus-accordion::accordion activeAccordion="0">
                        <x-zeus-accordion::accordion.item :label="'Tags'">
                            <ul class="list-disc ml-3">
                                @for ($i = 0; $i < count($image->tags); $i++)
                                    <li>{{ $image->tags[$i]->name }}</li>
                                @endfor
                            </ul>
                        </x-zeus-accordion::accordion.item>
                    </x-zeus-accordion::accordion>
                @endif
                @if ($image->style)
                    <h1 class="text-3xl font-bold mt-1">Style</h1>
                    <p>{{ $image->style->name }}</p>
                @endif
                <h1 class="text-3xl font-bold mt-1">Created At</h1>
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
