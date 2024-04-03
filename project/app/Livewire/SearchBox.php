<?php

namespace App\Livewire;

use Livewire\Component;

/**
 * Class SearchBox
 *
 * This class represents a Livewire component for a search box.
 */
class SearchBox extends Component {
    public $search = '';

    /**
     * Update the search value and dispatch an event.
     */
    public function updateSearch() {
        $this->dispatch('searchUpdated', $this->search);
    }

    /**
     * Render the Livewire component.
     */
    public function render() {
        return view('livewire.artivision.components.search-box');
    }
}
