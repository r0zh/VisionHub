<div class="relative py-2 px-2 rounded-md hover:bg-[#6e42c185] transition-all overflow-hidden w-[370px] h-[500px] flex items-center">
    <img src="@if ($image->public == 1) {{ asset('storage/' . $image->path) }} @else {{ url($image->path) }} @endif"
        alt="{{ $image->positivePrompt }}" class="object-cover rounded-lg cursor-pointer overflow-hidden h-[500px] w-[570px]"
        wire:click="selectImage({{ $image->id }})">
</div>
