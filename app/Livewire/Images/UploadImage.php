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

class UploadImage extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Create Image')->schema([
                    Grid::make([
                        'default' => 1,
                        'md' => 2
                    ])->schema([
                                Group::make()->schema([
                                    TextInput::make('name'),
                                    TextInput::make('positivePrompt'),
                                    TextInput::make('negativePrompt'),
                                    TextInput::make('seed')->numeric(),
                                    Select::make('style_id')->options(Style::pluck('name', 'id')->toArray())->label('Style'),
                                ]),

                                Group::make()->schema([
                                    Section::make('Tags')->schema([

                                        Select::make('tags')
                                            ->multiple()
                                            ->options(Tag::pluck('name', 'id')->toArray())
                                    ]),


                                    FileUpload::make('imagePath')->imageEditor()
                                        ->imageEditorAspectRatios([
                                            '16:9',
                                            '4:3',
                                            '1:1',
                                        ])
                                ])
                            ]),
                    Checkbox::make('public')
                ])
            ])
            ->statePath('data')
            ->model(Image::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();
        $data['user_id'] = auth()->id();
        $data['path'] = $data['imagePath'];

        $record = Image::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.images.upload-image');
    }
}