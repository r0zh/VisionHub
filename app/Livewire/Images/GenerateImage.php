<?php

namespace App\Livewire\Images;

use App\Models\Image;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class GenerateImage extends Component implements HasForms
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
        $data = $this->form->getState();

        $record = Image::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.images.generate-image');
    }
}