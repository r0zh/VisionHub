<p class="text-sm dark:text-white">
    @if ($type === 'checkpoint' && isset($this->imagePath))
        Request {{ $type }}
        {{ ($this->openRequestForm)(['type' => $type]) }}
    @else
        {{ __('Cannot find the :type you are looking for? Request it', ['type' => $type]) }}
        {{ ($this->openRequestForm)(['type' => $type]) }}
    @endif
</p>
