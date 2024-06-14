<?php

namespace App\Livewire\Admin;

use App\Filament\Resources\TagResource\Pages;
use App\Models\Image;

use Filament\Forms\Components\TextInput;


use Livewire\Component;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;




use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class ImageAdminResource extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $fetching;
    public $positivePrompt;
    public $negativePrompt;
    public $seed;
    public $imagePath;
    public $name;
    public $ratio = "1:1";
    public $style = "realistic";

    protected static ?string $model = Image::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    
    public static function table(Table $table): Table
    {
        return $table
            ->query(Image::query())
            ->columns([
                TextColumn::make('user.name')->label('User Name'),
                TextColumn::make('user.email')->label('Email'),
                TextColumn::make('name')->label('Name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                ]),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([

            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListImages::route('/'),
            'create' => Pages\CreateImage::route('/create'),
            'edit' => Pages\EditImage::route('/{record}/edit'),
        ];
    }
    protected $rules = [
        'name'            => 'required|string|min:2|max:255',
        'seed'            => 'required|numeric',
        'positive_prompt' => 'required|string|min:2',
        'negative_prompt' => '',
        'ratio'           => 'required',
        'style'           => 'required',
        'tags'            => 'required'
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
        //ñ$this->validate();
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
        //dd($this->form->getState());
        dd($this->name, $this->positivePrompt, $this->negativePrompt, $this->seed, $this->style, $this->imagePath);
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
    public function render(): View
    {

         if (request()->is('admin/images/create'))
            return view('livewire.visionHub.forms.form-image');
        return view('livewire.visionHub.lists.list-image');

        /* if (request()->is('admin/images/create')) {
            return view('livewire.visionHub.forms.form-image');
        } elseif (request()->is('admin/images/list')) {
            return view('livewire.visionHub.lists.list-image');
        }else
            return view('livewire.visionHub.forms.form-image');
         */

        /* $form = Form::make(); // Crear el formulario
        $this->form($form); // Configurar el esquema del formulario

        return view('livewire.visionHub.forms.form-image', [
        'form' => $form->schema()->render(), // Renderizar el formulario
    ]); */
    }
}