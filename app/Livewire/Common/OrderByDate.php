<?php

namespace App\Livewire\Common;

use Livewire\Component;

/**
 * Class OrderByDate
 * @package App\Livewire
 *
 * This class represents a Livewire component for ordering data by date.
 */
class OrderByDate extends Component
{
    public $direction = 'desc';

    /**
     * Update the order and dispatch an event.
     */
    public function updateOrder()
    {
        $this->dispatch('orderUpdated', $this->direction);
    }

    /**
     * Render the component.
     */
    public function render()
    {
        return view('livewire.common.order-by-date');
    }
}
