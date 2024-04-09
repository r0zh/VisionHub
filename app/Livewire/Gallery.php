<?php

namespace App\Livewire;

use App\Models\Image;
use Livewire\Attributes\On;
use Livewire\Component;

/**
 * Class Gallery
 * @package App\Livewire
 *
 * This class represents a Livewire component to manage the gallery page.
 */
class Gallery extends Component {
    public $images;

    public $filter = 'all';

    public $selectedImage = null;

    // search query
    public $search;

    // direction of image ordering
    public $direction = 'desc';

    /**
     * Mount the component and retrieve all images from the database.
     */
    public function mount() {
        $this->images = Image::where('user_id', auth()->id())->get();
    }

    /**
     * Update the filter value and fetch the images accordingly.
     * @param $filter
     */
    #[On('filterUpdated')]
    public function updateFilterVisibility($filter) {
        if ($filter != $this->filter) {
            $this->filter = $filter;
            $this->getImages();
        }
    }

    /**
     * Update the search value and fetch the images accordingly.
     * @param $search
     */
    #[On('searchUpdated')]
    public function updateSearch($search) {
        if ($search != $this->search) {
            $this->search = $search;
            $this->getImages();
        }

    }

    /**
     * Update the order direction and fetch the images accordingly.
     * @param $direction
     */
    #[On('orderUpdated')]
    public function updateOrder($direction) {
        if ($direction != $this->direction) {
            $this->direction = $direction;
            $this->getImages();
        }
    }

    /**
     * Fetch the images based on the current filter, search, and order direction.
     */
    public function getImages() {
        if ($this->filter == 'all') {
            $this->images = Image::where('user_id', auth()->id())
                ->where('positivePrompt', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', $this->direction)
                ->get();
        } elseif ($this->filter == 'public') {
            $this->images = Image::where('user_id', auth()->id())
                ->where('public', true)
                ->where('positivePrompt', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', $this->direction)
                ->get();
        } elseif ($this->filter == 'private') {
            $this->images = Image::where('user_id', auth()->id())
                ->where('public', false)
                ->where('positivePrompt', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', $this->direction)
                ->get();
        }
    }

    /**
     * Update the filter value and fetch the images accordingly.
     */
    #[On('imageDeleted')]
    public function imageDeleted() {
        $this->getImages();
    }

    /**
     * Fetch the images when the image visibility is updated.
     */
    #[On('imageVisibilityUpdated')]
    public function imageVisibilityUpdated() {
        $this->getImages();
    }

    /**
     * Handle the event when an image is selected.
     * Dispatch the 'openModal' event with the 'ImageDetails' component and the image ID as parameters.
     * @param $id
     */
    #[On('imageSelected')]
    public function imageSelected($id) {
        $this->dispatch('openModal', 'ImageDetails', ['id' => $id]);
    }

    /**
     * Render the Livewire component.
     */
    public function render() {
        return view('livewire.artivision.gallery');
    }
}
