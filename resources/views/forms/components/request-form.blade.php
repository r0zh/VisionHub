<p class="text-sm dark:text-white">
    @if ($type === 'checkpoint' && $this->imagePath)
        Request {{ $type }}
        {{ ($this->openRequestForm)(['type' => $type]) }}
    @else
        Cannot find the
        {{ $type }} you are looking for? Request it
        {{ ($this->openRequestForm)(['type' => $type]) }}
    @endif
</p>
