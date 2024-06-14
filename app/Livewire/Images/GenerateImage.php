<?php

namespace App\Livewire\Images;

use App\Models\Checkpoint;
use App\Models\Image;
use App\Models\ResourceRequest;
use Filament\Actions\Action;
use Filament\Forms\Components\Actions\Action as FormAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;

use Filament\Forms\Form;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Radio;

use Illuminate\Support\HtmlString;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;


class GenerateImage extends Component implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;

    public ?array $data = [];
    private $fetching;
    private $imagePath;

    private $temporal;

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
                                Select::make('style_id')->preload()->relationship(name: 'style', titleAttribute: 'name'),
                                Select::make('checkpoint_id')->preload()->relationship(name: 'checkpoint', titleAttribute: 'name')->required()->hint(view('forms.components.request-form', ['type' => 'checkpoint'])),
                                TextInput::make('positivePrompt')->required(),
                                TextInput::make('negativePrompt'),
                                TextInput::make('seed')->numeric()->required()->maxValue(4294967296)->minValue(0),
                                Select::make('ratio')->options([
                                    '2:3' => '2:3',
                                    '1:1' => '1:1',
                                ])->required(),
                            ])->extraAttributes(['class' => 'custom-section-style']),

                    Repeater::make('loras')
                        ->schema([
                            Select::make('lora_id')->relationship(name: 'loras', titleAttribute: 'name')->label("Lora name")->required(),
                            TextInput::make('weight')->numeric()->required()->maxValue(1.0)->minValue(-1.0)->step(0.01),

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
                        ->hint(view('forms.components.request-form', ['type' => 'lora'])),

                    Repeater::make('embeddings')
                        ->columns([
                            'default' => 1,
                            'sm' => 1,
                            'md' => 5,
                            'lg' => 5,
                            'xl' => 5,
                            '2xl' => 5,
                        ])
                        ->schema([
                            Select::make('embedding_id')->relationship(name: 'embeddings', titleAttribute: 'name')->label("Embedding name")->required()->columnSpan(2),
                            TextInput::make('weight')->numeric()->required()->maxValue(1.0)->minValue(-1.0)->step(0.01)->columnSpan(2),
                            Radio::make('effect')
                                ->options([
                                    'positive' => 'Positive',
                                    'negative' => 'Negative',
                                ])
                                ->inline()
                                ->inlineLabel(false)
                        ])->extraItemActions([
                                FormAction::make('LoraInfo')->icon('heroicon-m-information-circle')->color('info')->modalSubmitAction(false)->modalCancelActionLabel('Close')->modalContent(view('info.embedding'))
                            ])
                        ->cloneable()
                        ->defaultItems(0)
                        ->columns(2)
                        ->hint(view('forms.components.request-form', ['type' => 'embedding'])),
                ])
            ])
            ->statePath('data')
            ->model(Image::class);
    }

    public function create(): void
    {
        $this->fetching = true;
        $data = $this->form->getState();
        $data['checkpoint'] = Checkpoint::find($data['checkpoint_id'])->fileName;
        $apiUrl = config('services.flask') . '/generate';
        //display jpeg response
        $response = Http::timeout(5 * 60)->post($apiUrl, $data);

        // display the image in the browser
        $image = $response->getBody();
        if ($response->status() !== 200) {
            return;
        }
        $this->imagePath = "images/tmp/" . Str::of($response->getHeader('Content-Disposition')[0])->after('filename=');
        Storage::disk('public')->put($this->imagePath, $image);

        session(['imagePath' => $this->imagePath]);

        $this->fetching = false;
    }

    public function saveImage($data)
    {
        $enrichedData = array_merge($data, $this->form->getState());
        $enrichedData['user_id'] = Auth::user()->id;
        $enrichedData['checkpoint'] = Checkpoint::find($enrichedData['checkpoint_id'])->fileName;
        $path = str_replace("images/tmp/", "", session('imagePath'));

        if ($enrichedData['public']) {
            $newPath = "images/" . auth()->id() . '_' . explode('@', auth()->user()->email)[0] . '/' . $path;
            $enrichedData['path'] = $newPath;
            Storage::disk('public')->put($newPath, Storage::disk('public')->get(session('imagePath')));
        } else {
            $newPath = "private/images/" . auth()->id() . '_' . explode('@', auth()->user()->email)[0] . '/' . $path;
            $enrichedData['path'] = $newPath;
            Storage::disk('local')->put($newPath, Storage::disk('public')->get(session('imagePath')));
        }

        Storage::disk('public')->delete(session('imagePath'));
        $record = Image::create($enrichedData);

        $this->form->model($record)->saveRelationships();

        // redirect to gallery
        return redirect()->to('/gallery');
    }

    public function saveImageAction(): Action
    {
        return Action::make('saveImageAction')
            ->label('Save Image')
            ->modalContent(view('livewire.images.generate.save-image-form', ['imagePath' => session('imagePath')]))
            ->form([
                TextInput::make('name')
                    ->nullable()
                    ->maxLength(255),
                TextInput::make('description')
                    ->nullable(),
                Select::make('tags')
                    ->multiple()
                    ->preload()
                    ->relationship('tags', 'name')
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required(),
                    ]),
                Checkbox::make('public')
            ])
            ->model(Image::class)
            ->action(function (array $data): void {
                $this->saveImage($data);
            });
    }

    public function openRequestForm(): Action
    {
        return Action::make('openRequestForm')
            ->label('here')
            ->modalHeading('Resource request')
            ->form([
                TextInput::make('resource_name')
                    ->maxLength(255)->required(),
                TextInput::make('resource_url')->required(),
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


    public function render(): View
    {
        return view('livewire.images.generate-image');
    }
}