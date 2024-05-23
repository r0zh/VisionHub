<?php

namespace App\Livewire\Images;

use App\Models\Image;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GenerateImage extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    private $fetching;
    private $imagePath;


    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('style_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('path')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('seed')
                    ->required()
                    ->numeric(),
                Forms\Components\Textarea::make('positivePrompt')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('negativePrompt')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('public')
                    ->required(),
                Forms\Components\TextInput::make('description')
                    ->maxLength(255),
            ])
            ->statePath('data')
            ->model(Image::class);
    }

    public function create(): void
    {
        $this->fetching = true;
        $data = $this->form->getState();
        $apiUrl = config('services.flask') . '/get_image';
        //display jpeg response
        $response = Http::post($apiUrl, $data);

        // display the image in the browser
        $image = $response->getBody();
        $this->imagePath = "images/tmp/" . Str::of($response->getHeader('Content-Disposition')[0])->after('filename=');
        Storage::disk('public')->put($this->imagePath, $image);

        $this->fetching = false;
    }

    public function save($data): void
    {
        $record = Image::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.images.generate-image');
    }
}