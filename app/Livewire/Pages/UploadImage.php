<?php

namespace App\Livewire\Pages;

use App\Models\Image;
use App\Models\ResourceRequest;
use App\Rules\AllowedRatios;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Actions\Action as FormAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;


class UploadImage extends Component implements HasForms, HasActions
{
    use InteractsWithForms, InteractsWithActions;

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
                    TextInput::make('name')->nullable(),
                    Textarea::make('description')->nullable(),
                    Grid::make([
                        'default' => 1,
                        'md' => 2
                    ])->schema([

                                Select::make('style_id')->preload()->relationship(name: 'style', titleAttribute: 'name'),
                                Select::make('checkpoint_id')->preload()->relationship(name: 'checkpoint', titleAttribute: 'name')->required()->hint(view('livewire.common.request-form', ['type' => 'checkpoint'])),
                                TextInput::make('positivePrompt')->required(),
                                TextInput::make('negativePrompt'),
                                TextInput::make('seed')->numeric()->required()->maxValue(4294967296)->minValue(0)->default(rand(1, 4294967296)),
                                Select::make('tags')
                                    ->multiple()
                                    ->preload()
                                    ->relationship('tags', 'name')
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->required(),
                                    ]),
                            ])->extraAttributes(['class' => 'custom-section-style']),
                    Repeater::make('loras')
                        ->relationship('imageLoras')
                        ->schema([
                            Select::make('lora_id')->relationship(name: 'lora', titleAttribute: 'name')->label("Lora name")->required(),
                            TextInput::make('weight')->numeric()->required()->maxValue(1.0)->minValue(-1.0)->step(0.01)->default(1),

                        ])
                        ->extraItemActions([
                            FormAction::make('LoraInfo')
                                ->icon('heroicon-m-information-circle')
                                ->color('info')
                                ->modalSubmitAction(false)
                                ->modalCancelActionLabel('Close')
                                ->modalContent(view('info.lora'))
                        ])
                        ->cloneable()
                        ->defaultItems(0)
                        ->columns(2)
                        ->hint(view('livewire.common.request-form', ['type' => 'lora'])),

                    Repeater::make('embeddings')
                        ->columns([
                            'default' => 1,
                            'sm' => 1,
                            'md' => 5,
                            'lg' => 5,
                            'xl' => 5,
                            '2xl' => 5,
                        ])
                        ->relationship('imageEmbeddings')
                        ->schema([
                            Select::make('embedding_id')->relationship(name: 'embedding', titleAttribute: 'name')->label("Embedding name")->required()->columnSpan(2),
                            TextInput::make('weight')->numeric()->required()->maxValue(1.0)->minValue(-1.0)->step(0.01)->columnSpan(2)->default(1),
                            Radio::make('prompt_target')
                                ->options([
                                    'positive' => 'Positive',
                                    'negative' => 'Negative',
                                ])
                                ->inline()
                                ->inlineLabel(false)
                                ->required()
                        ])->extraItemActions([
                                FormAction::make('LoraInfo')->icon('heroicon-m-information-circle')->color('info')->modalSubmitAction(false)->modalCancelActionLabel('Close')->modalContent(view('info.embedding'))
                            ])
                        ->cloneable()
                        ->defaultItems(0)
                        ->columns(2)
                        ->hint(view('livewire.common.request-form', ['type' => 'embedding'])),

                    FileUpload::make('imagePath')->imageEditor()->visibility('private')
                        ->imageEditorAspectRatios([
                            '2:3',
                            '1:1',
                        ])->image()
                        ->label('Upload Image')
                        ->rule(new AllowedRatios())
                        ->validationMessages([
                            'AllowedRatios' => 'Image must have a 2:3 or 1:1 aspect ratio. Use the editor to crop it please.',
                        ])
                        ->required(),
                    Toggle::make('public')
                        ->onColor('success')
                        ->offColor('danger')
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

    public function openRequestForm(): Action
    {
        return Action::make('openRequestForm')
            ->label('here')
            ->modalHeading('Resource request')
            ->form([
                TextInput::make('resource_name')
                    ->maxLength(255)->required(),
                TextInput::make('resource_url')->url()->required(),
                TextInput::make('resource_description')
                    ->nullable()
            ])
            ->model(Image::class)
            ->action(function (array $arguments, array $data): void {
                $data['request_type'] = $arguments['type'];
                $data['sender_id'] = Auth::user()->id;
                ResourceRequest::create($data);
            })->link()
        ;
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