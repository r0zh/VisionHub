<?php

namespace App\Livewire\Images;

use App\Models\Image;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;

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
                Section::make('Upload Image')->schema([
                    Grid::make([
                        'default' => 1,
                        'md' => 2
                    ])->schema([
                                Group::make()->schema([
                                    Select::make('style_id')->preload()->relationship(name: 'style', titleAttribute: 'name')->required(),
                                    Select::make('checkpoint_id')->preload()->relationship(name: 'checkpoint', titleAttribute: 'name')->required(),
                                    TextInput::make('positivePrompt')->required(),
                                    TextInput::make('negativePrompt')->required(),
                                    TextInput::make('seed')->numeric()->required()->maxValue(4294967296),
                                    Select::make('loras')
                                        ->multiple()
                                        ->preload()
                                        ->relationship('loras', 'name')
                                        ->createOptionForm([
                                            TextInput::make('name')
                                                ->required(),
                                            TextInput::make('fileName')
                                                ->required(),
                                            RichEditor::make('description')->nullable(),
                                        ]),

                                    Select::make('embeddings')
                                        ->multiple()
                                        ->preload()
                                        ->relationship('embeddings', 'name')
                                        ->createOptionForm([
                                            TextInput::make('name')
                                                ->required(),
                                            TextInput::make('fileName')
                                                ->required(),
                                            RichEditor::make('description')->nullable(),
                                        ]),

                                ]),

                                Group::make()->schema([
                                    Select::make('style_id')->preload()->relationship(name: 'style', titleAttribute: 'name')->required(),
                                ]),

                            ]),
                ])
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

    public function save($data)
    {
        $record = Image::create($data);

        $this->form->model($record)->saveRelationships();

        $userPath = Auth::user()->id . '_' . explode('@', Auth::user()->email)[0];
        Storage::disk('public')->move($this->imagePath, 'images/' . $userPath . '/' . $this->name . '.png');

        // save the image path to the database
        $imagePath = 'images/' . $userPath . '/' . $this->name . '.png';
        Image::create([
            'seed' => $this->seed,
            'positivePrompt' => $this->positive_prompt,
            'negativePrompt' => $this->negative_prompt,
            'public' => true,
            'style' => $this->style,
            // Store the image in the public or private directory
            'path' => $imagePath,
            'created_at' => now(),
            'user_id' => Auth::user()->id,
        ]);

        // redirect to gallery
        return redirect()->to('/gallery');
    }

    public function render(): View
    {
        return view('livewire.images.generate-image');
    }
}