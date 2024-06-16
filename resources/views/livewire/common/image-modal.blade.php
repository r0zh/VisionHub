<img src="@if ($image->public == 1) {{ asset('storage/' . $image->path) }} @else {{ url($image->path) }} @endif"
    alt="{{ $image->positivePrompt }}" class="xl:w-fit max-h-[80vh] rounded-xl shadow-lg" />
