<div>
    <div class="py-2 rounded-lg dark:text-white dark:bg-gray-800">
        <div class="flex flex-wrap justify-center items-center space-x-4">
            <livewire:common.filter-visibility />
            <livewire:common.order-by-date />
            <livewire:common.search-box />
        </div>
    </div>
    @if ($images->isEmpty())
        <div class="flex justify-center items-start p-4">
            <div
                class="relative py-3 px-4 text-yellow-800 bg-yellow-100 rounded dark:text-yellow-100 dark:bg-yellow-800">
                <strong class="font-bold">No Images Found!</strong>
                <span class="block sm:inline">There are currently no images to display.</span>
            </div>
        </div>
    @else
        <div class="py-7 px- flex flex-wrap flex-row justify-center items-center gap-y-4">
            @foreach ($images as $image)
                <livewire:common.image-component :image="$image" :wire:key="$image->id" lazy />
            @endforeach
        </div>
    @endif
    <livewire:common.image-info-modal lazy />
</div>
