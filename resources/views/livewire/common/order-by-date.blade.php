<select class="rounded dark:text-white dark:bg-gray-700" wire:model="direction" wire:change="updateOrder">
    <option value="asc">{{ __('Ascending') }}</option>
    <option value="desc">{{ __('Descending') }}</option>
</select>
