<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;

/**
 * Class Create
 *
 * This class represents the Livewire component for creating an image in the Artivision application.
 * It handles the fetching of image data, saving the image, and rendering the view.
 */
class Create extends Component
{
    // Properties
    public $fetching;
    public $positive_prompt;
    public $negative_prompt;
    public $seed;
    public $imagePath;
    public $name;
    public $ratio = "1:1";
    public $style = "realistic";

    // Validation rules
    protected $rules = [
        'name'            => 'required|string|min:2|max:255',
        'seed'            => 'required|numeric',
        'positive_prompt' => 'required|string|min:2',
        'negative_prompt' => '',
        'ratio'           => 'required',
        'style'           => 'required'
    ];

    /**
     * Mount the component.
     *
     * This method is called when the component is being mounted.
     * It initializes the $fetching property.
     */
    public function mount()
    {
        $this->fetching = false;
    }

    /**
     * Fetch the image data.
     *
     * This method is called when the user clicks the fetch button.
     * It sets the $fetching property to true, validates the form data,
     * and dispatches the 'fetch-image' event.
     */
    public function fetch()
    {
        $this->fetching = true;
        $this->validate();
        $this->dispatch('fetch-image');
    }

    /**
     * Handle the 'fetch-image' event.
     *
     * This method is called when the 'fetch-image' event is dispatched.
     * It retrieves the form data, sends a POST request to the image API,
     * saves the image to storage, and sets the $fetching property to false.
     */
    #[On('fetch-image')]
    public function fetchImage()
    {
        // get data from the form
        $this->positive_prompt;
        $this->negative_prompt;
        $this->seed;
        $json     = json_encode(['positivePrompt' => $this->positive_prompt, 'negativePrompt' => $this->negative_prompt, "seed" => $this->seed, "ratio" => $this->ratio, "style" => $this->style]);
        $address  = "https://1843-2a0c-5a85-6402-c500-dee3-dd3c-b34e-c0d2.ngrok-free.app/get_image";
        $response = Http::withBody($json, 'application/json')->timeout(60 * 5)
            ->withHeaders([
                'Content-Type' => 'application/json',
            ])->post($address);
        // display the image in the browser
        $image           = $response->getBody();
        $this->imagePath = "images/tmp/image.png";
        Storage::disk('public')->put($this->imagePath, $image);
        $this->fetching = false;
    }

    /**
     * Save the image.
     *
     * This method is called when the user clicks the save button.
     * It moves the image to the user's directory, saves the image path to the database,
     * and redirects to the gallery page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveImage()
    {
        // move the image to the public or private directory
        $userPath = Auth::user()->id . '_' . explode('@', Auth::user()->email)[0];
        Storage::disk('public')->move($this->imagePath, 'images/' . $userPath . '/' . $this->name . '.png');

        // save the image path to the database
        $imagePath = 'images/' . $userPath . '/' . $this->name . '.png';
        Image::create([
            'seed'           => $this->seed,
            'positivePrompt' => $this->positive_prompt,
            'negativePrompt' => $this->negative_prompt,
            'public'         => true,
            'style'          => $this->style,
            // Store the image in the public or private directory
            'path'           => $imagePath,
            'created_at'     => now(),
            'user_id'        => Auth::user()->id,
        ]);

        // redirect to gallery
        return redirect()->to('/gallery');
    }

    /**
     * Render the component.
     *
     * This method is called to render the component's view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.artivision.create');
    }
}
