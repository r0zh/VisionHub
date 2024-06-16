    <select id="toggle" wire:model="filter" wire:change="updateFilter" class="rounded dark:text-white dark:bg-gray-700">
        <option value="all">{{ __('All') }}</option>
        <option value="public">{{ trans_choice('Public',4) }}</option>
        <option value="private">{{ trans_choice('Private',4) }}</option>
    </select>
