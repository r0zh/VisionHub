<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Image;
use Livewire\Attributes\On;

/**
 * This class represents the Livewire component for the community page.
 * It handles the display and interaction with images in the community.
 *
 * @package App\Livewire
 */
class Community extends Component {
    public $images;

    public $selectedImage = null;

    // search query.
    public $search;

    // direction of image ordering
    public $direction = 'desc';

    /**
     * Mount the component and retrieve all images from the database.
     */
    public function mount() {
        $this->images         = Image::all()->where('public', true);
        $this->filteredImages = $this->images;
        $this->searchedImages = $this->filteredImages;
        $this->orderedImages  = $this->searchedImages->sortByDesc('created_at');
    }

    /**
     * Update the search query and fetch the images accordingly.
     * @param string $search
     */
    #[On('searchUpdated')]
    public function updateSearch($search) {
        if ($search != $this->search) {
            $this->search = $search;
            $this->getImages();
        }
    }

    /**
     * Update the image ordering direction and fetch the images accordingly.
     * @param string $direction
     */
    #[On('orderUpdated')]
    public function updateOrder($direction) {
        if ($direction != $this->direction) {
            $this->direction = $direction;
            $this->getImages();
        }
    }

    /**
     * Fetch the images based on the search query and ordering direction.
     */
    public function getImages() {
        $this->images = Image::where('positivePrompt', 'like', '%' . $this->search . '%')
            ->where('public', true)
            ->orderBy('created_at', $this->direction)
            ->get();
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
     * Render the component.
     */
    public function render() {
        return view('livewire.artivision.community');
    }
}
