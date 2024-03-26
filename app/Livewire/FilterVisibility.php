<?php

namespace App\Livewire;


use LivewireUI\Modal\ModalComponent;

/**
 * Class FilterVisibility
 * 
 * This class represents a Livewire component for managing filter visibility.
 */
class FilterVisibility extends ModalComponent {
    public $filter = 'all';

    /**
     * Update the filter value and dispatch an event.
     *
     * @return void
     */
    public function updateFilter() {
        $this->dispatch('filterUpdated', $this->filter);
    }

    /**
     * Render the Livewire component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render() {
        return view('livewire.artivision.components.filter-visibility');
    }
}
