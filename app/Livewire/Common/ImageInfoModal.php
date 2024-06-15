<?php

namespace App\Livewire\Common;

use Livewire\Component;
use App\Models\Image;
use Illuminate\Support\Carbon;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;

class ImageInfoModal extends Component
{
    public $image;
    public $dateCreated;

    #[On('imageSelected')]
    public function imageSelected(Image $image)
    {
        $this->image = $image;
        $this->dateCreated = Carbon::parse($this->image->created_at)->format('d/m/Y');
    }

    public function mount()
    {
        $this->image = Image::find(1);
        $this->dateCreated = Carbon::parse($this->image->created_at)->format('d/m/Y');
    }

    public function togglePublic()
    {
        if ($this->image->public) {
            // Move the image to private/images directory, delete the public image and update the path
            $newPath = Str::replaceFirst('images/', 'private/images/', $this->image->path);
            Storage::disk('local')->put($newPath, Storage::disk('public')->get($this->image->path));
            Storage::disk('public')->delete($this->image->path);
            $this->image->path = $newPath;
        } else {
            // Move the image to images public directory, delete the private image and update the path
            $newPath = Str::replaceFirst('private/images/', 'images/', $this->image->path);
            Storage::disk('public')->put($newPath, Storage::disk('local')->get($this->image->path));
            Storage::disk('local')->delete($this->image->path);
            $this->image->path = $newPath;
        }

        // Toggle the public flag 
        $this->image->public = !$this->image->public;
        $this->image->save();
        $this->dispatch('imageVisibilityUpdated');
        if ($this->image->public) {
            Notification::make()
                ->title('Image is now public')
                ->icon('heroicon-o-lock-open')
                ->color('success')
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Image is now private')
                ->icon('heroicon-o-lock-closed')
                ->color('success')
                ->success()
                ->send();
        }
    }

    public function deleteImage()
    {
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
        $this->dispatch('close-modal', id: 'image-info-modal');
        $this->dispatch('imageDeleted');

        Notification::make()
            ->title('Deleted successfully')
            ->icon('heroicon-o-trash')
            ->color('success')
            ->success()
            ->send();
    }

    public function render()
    {
        return view('livewire.common.image-info-modal');
    }
}
