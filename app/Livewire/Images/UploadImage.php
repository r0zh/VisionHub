<?php

namespace App\Livewire\Images;

use App\Models\Image;
use App\Models\Style;
use App\Models\Tag;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;

use Livewire\Component;
use Illuminate\Contracts\View\View;

use Illuminate\Support\Facades\Storage;

class UploadImage extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    public bool $bool = false;

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
                                    TextInput::make('name')->nullable(),
                                    RichEditor::make('description')->nullable(),
                                    Select::make('tags')
                                        ->multiple()
                                        ->preload()
                                        ->relationship('tags', 'name')
                                        ->createOptionForm([
                                            TextInput::make('name')
                                                ->required(),
                                        ]),
                                    Select::make('style_id')->preload()->relationship(name: 'style', titleAttribute: 'name')->required(),
                                    Select::make('checkpoint_id')->preload()->relationship(name: 'checkpoint', titleAttribute: 'name')->required(),
                                ]),

                                Group::make()->schema([
                                    TextInput::make('positivePrompt')->required(),
                                    TextInput::make('negativePrompt')->required(),
                                    Select::make('lora_id')
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
                                    Select::make('embedding_id')
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

                                    TextInput::make('seed')->numeric()->required()->maxValue(4294967296),

                                    FileUpload::make('imagePath')->imageEditor()->visibility('private')
                                        ->imageEditorAspectRatios([
                                            '16:9',
                                            '4:3',
                                            '1:1',
                                        ])->image()->label('Upload Image')->required(),
                                    Checkbox::make('public')
                                ])
                            ]),
                ])
            ])
            ->statePath('data')
            ->model(Image::class);
    }

    public function create()
    {
        $formData = $this->form->getState();
        $formData['user_id'] = auth()->id();
        if ($formData['public']) {
            $newPath = "images/" . auth()->id() . '_' . explode('@', auth()->user()->email)[0] . '/' . $formData['imagePath'];
            $formData['path'] = $newPath;
            Storage::disk('public')->put($newPath, Storage::disk('public')->get($formData['imagePath']));
        } else {
            $newPath = "private/images/" . auth()->id() . '_' . explode('@', auth()->user()->email)[0] . '/' . $formData['imagePath'];
            $formData['path'] = $newPath;
            Storage::disk('local')->put($newPath, Storage::disk('public')->get($formData['imagePath']));
        }

        Storage::disk('public')->delete($formData['imagePath']);

        $record = Image::create($formData);
        $this->form->model($record)->saveRelationships();

        return redirect()->to('/gallery');
    }

    public function resetForm()
    {
        $this->reset();
    }

    public function render(): View
    {
        return view('livewire.images.upload-image');
    }
}