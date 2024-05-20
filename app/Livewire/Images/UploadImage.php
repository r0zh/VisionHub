<?php

namespace App\Livewire\Images;

use App\Models\Image;
use App\Models\Style;
use App\Models\Tag;

use Filament\Forms\Components\Grid;
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
                        'md'      => 2
                    ])->schema([
                                Group::make()->schema([
                                    TextInput::make('name'),
                                    TextInput::make('description')->nullable(),
                                    TextInput::make('positivePrompt')->required(),
                                    TextInput::make('negativePrompt')->required(),
                                    TextInput::make('seed')->numeric()->required()->maxValue(4294967296),

                                ]),

                                Group::make()->schema([
                                    Select::make('style_id')->live()->preload()->relationship(name: 'style', titleAttribute: 'name')->required(),


                                    Select::make('tags')
                                        ->multiple()
                                        ->live()
                                        ->disabled(function (): bool {
                                            if ($this->data['style_id']) {
                                                return true;
                                            } else {
                                                return false;
                                            };
                                        })
                                        ->preload()
                                        ->relationship('tags', 'name')
                                        ->createOptionForm([
                                            TextInput::make('name')
                                                ->required(),
                                        ]),


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

    public function create(): void
    {
        $data            = $this->form->getState();
        $data['user_id'] = auth()->id();
        if ($data['public']) {
            $newPath      = "images/" . auth()->id() . '_' . explode('@', auth()->user()->email)[0] . '/' . $data['imagePath'];
            $data['path'] = $newPath;
            Storage::disk('public')->put($newPath, Storage::disk('public')->get($data['imagePath']));
        } else {
            $newPath      = "private_images/" . auth()->id() . '_' . explode('@', auth()->user()->email)[0] . '/' . $data['imagePath'];
            $data['path'] = $newPath;
            Storage::disk('local')->put($newPath, Storage::disk('public')->get($data['imagePath']));
        }

        Storage::disk('public')->delete($data['imagePath']);

        $record = Image::create($data);
        $this->form->model($record)->saveRelationships();
    }

    public function resetName(): void
    {
        $this->reset('data.name');
        $this->bool = true;
    }

    public function render(): View
    {
        return view('livewire.images.upload-image');
    }
}