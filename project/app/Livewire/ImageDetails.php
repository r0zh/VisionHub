<?php

namespace App\Livewire;

use App\Models\Image;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use LivewireUI\Modal\ModalComponent;

/**
 * Class Gallery
 * @package App\Livewire
 * 
 * This class represents a Livewire component for displaying and managing image details.
 * It extends the ModalComponent class.
 */
class ImageDetails extends ModalComponent {

    public $image;

    public $dateCreated;

    /**
     * Mount the component with the given image ID.
     *
     * @param int $id The image ID.
     * @return void
     */
    public function mount($id) {
        // Retrieve the image by ID
        $this->image = Image::find($id);

        // Format the created_at date
        $this->dateCreated = Carbon::parse($this->image->created_at)->format('d/m/Y');
    }

    /**
     * Toggle the public visibility of the image.
     *
     * @return void
     */
    public function togglePublic() {
        if ($this->image->public) {
            // Move the image to private_images directory, delete the public image and update the path
            $newPath = Str::replaceFirst('images/', 'private_images/', $this->image->path);
            Storage::disk('local')->put($newPath, Storage::disk('public')->get($this->image->path));
            Storage::disk('public')->delete($this->image->path);
            $this->image->path = $newPath;
        } else {
            // Move the image to images public directory, delete the private image and update the path
            $newPath = Str::replaceFirst('private_images/', 'images/', $this->image->path);
            Storage::disk('public')->put($newPath, Storage::disk('local')->get($this->image->path));
            Storage::disk('local')->delete($this->image->path);
            $this->image->path = $newPath;
        }

        // Toggle the public flag 
        $this->image->public = !$this->image->public;
        $this->image->save();

        $this->dispatch('imageVisibilityUpdated');
    }

    /**
     * Delete the image.
     *
     * @return void
     */
    public function deleteImage() {
        // Destroy the image file
        $path = Str::replaceFirst('storage/', '', $this->image->path);
        if ($this->image->public) {
            Storage::disk('public')->delete($path);
            $this->image->delete();
        } else {
            Storage::disk('local')->delete($path);
            $this->image->delete();
        }

        // Close the modal and dispatch the 'imageDeleted' event
        $this->closeModal();
        $this->dispatch('imageDeleted');
    }

    /**
     * Handle the 'imageVisibilityUpdated' event.
     */
    #[On('imageVisibilityUpdated')]
    public function imageVisibilityUpdated() {
        // Refresh the image object
        $this->image = Image::find($this->image->id);
    }

    /**
     * Render the component.
     */
    public function render() {
        return view('livewire.artivision.components.image-details');
    }
}
