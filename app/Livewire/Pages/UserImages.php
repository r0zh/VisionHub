<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Image;
use App\Models\User;
use Filament\Notifications\Notification;

use Livewire\Attributes\On;


class UserImages extends Component
{
    public string $user_id;

    public $images;

    public $filter = 'all';

    // search query
    public $search;

    // direction of image ordering
    public $direction = 'desc';

    /**
     * Mount the component and retrieve all images from the database.
     */
    public function mount(string $user_id)
    {
        $this->user_id = $user_id;
        if ($this->canView()) {
            $this->images = Image::where('user_id', $user_id)->get();
        } else {
            $this->images = Image::where('user_id', $user_id)->where('public', true)->get();
        }
    }

    public function canView()
    {
        return $this->user_id == auth()->id() || auth()->user()->role->name == 'moderator' || auth()->user()->role->name == 'admin';
    }

    public function getUser()
    {
        return User::find($this->user_id);
    }

    /**
     * Update the filter value and fetch the images accordingly.
     * @param $filter
     */
    #[On('filterUpdated')]
    public function updateFilterVisibility($filter)
    {
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
    public function updateSearch($search)
    {
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
    public function updateOrder($direction)
    {
        if ($direction != $this->direction) {
            $this->direction = $direction;
            $this->getImages();
        }
    }

    /**
     * Fetch the images based on the current filter, search, and order direction.
     */
    public function getImages()
    {
        if ($this->canView()) {
            if ($this->filter == 'all') {
                $this->images = Image::where('user_id', $this->user_id)
                    ->where('positivePrompt', 'like', '%' . $this->search . '%')
                    ->orderBy('created_at', $this->direction)
                    ->get();
            } elseif ($this->filter == 'public') {
                $this->images = Image::where('user_id', $this->user_id)
                    ->where('public', true)
                    ->where('positivePrompt', 'like', '%' . $this->search . '%')
                    ->orderBy('created_at', $this->direction)
                    ->get();
            } elseif ($this->filter == 'private') {
                $this->images = Image::where('user_id', $this->user_id)
                    ->where('public', false)
                    ->where('positivePrompt', 'like', '%' . $this->search . '%')
                    ->orderBy('created_at', $this->direction)
                    ->get();
            }
        }
    }

    /**
     * Update the filter value and fetch the images accordingly.
     */
    #[On('imageDeleted')]
    public function imageDeleted()
    {
        $this->getImages();
    }

    /**
     * Fetch the images when the image visibility is updated.
     */
    #[On('imageVisibilityUpdated')]
    public function imageVisibilityUpdated()
    {
        $this->getImages();
    }

    public function loadMore()
    {
        Notification::make()
            ->title('Saved successfully')
            ->send();
    }

    /**
     * Render the Livewire component.
     */

    public function render()
    {
        return view('livewire.pages.user-images');
    }
}
