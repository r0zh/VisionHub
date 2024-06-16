<?php

namespace App\Livewire\Pages;

use App\Models\Checkpoint;
use App\Models\Embedding;
use App\Models\Image;
use App\Models\Lora;
use App\Models\ResourceRequest;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Actions\Action as FormAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;


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
                Section::make(__('Generate Image'))
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'md' => 2
                        ])->schema([
                                    Select::make('checkpoint_id')->preload()->relationship(name: 'checkpoint', titleAttribute: 'name')->required()->hint(view('livewire.common.request-form', ['type' => 'checkpoint'])),
                                    TextInput::make('positivePrompt')->label(__('Positive Prompt'))->required(),
                                    TextInput::make('negativePrompt')->label(__('Negative Prompt')),
                                    TextInput::make('seed')->label(__('Seed'))->numeric()->required()->maxValue(4294967296)->minValue(0)->default(rand(1, 4294967296)),
                                    Select::make('ratio')->options([
                                        '2:3' => '2:3',
                                        '1:1' => '1:1',
                                    ])->required(),
                                ])->extraAttributes(['class' => 'custom-section-style']),

                        Repeater::make('loras')
                            ->relationship('imageLoras')
                            ->schema([
                                Select::make('lora_id')->relationship(name: 'lora', titleAttribute: 'name')->label(__('Lora name'))->required(),
                                TextInput::make(__('weight'))->numeric()->required()->maxValue(1.0)->minValue(-1.0)->step(0.01)->default(1),

                            ])
                            ->extraItemActions([
                                FormAction::make('LoraInfo')
                                    ->icon('heroicon-m-information-circle')
                                    ->color('info')
                                    ->modalSubmitAction(false)
                                    ->modalCancelActionLabel(__('Close'))
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
                                Select::make('embedding_id')->relationship(name: 'embedding', titleAttribute: 'name')->label(__('Embedding name'))->required()->columnSpan(2),
                                TextInput::make(__('weight'))->numeric()->required()->maxValue(1.0)->minValue(-1.0)->step(0.01)->columnSpan(2)->default(1),
                                Radio::make('prompt_target')->label(__('Prompt target'))
                                    ->options([
                                        'positive' => __('Positive'),
                                        'negative' => __('Negative'),
                                    ])
                                    ->inline()
                                    ->inlineLabel(false)
                                    ->required()
                            ])->extraItemActions([
                                    FormAction::make('EmbeddingInfo')->icon('heroicon-m-information-circle')->color('info')->modalSubmitAction(false)->modalCancelActionLabel(__('Close'))->modalContent(view('info.embedding'))
                                ])
                            ->cloneable()
                            ->defaultItems(0)
                            ->columns(2)
                            ->hint(view('livewire.common.request-form', ['type' => 'embedding'])),
                        Toggle::make('highQ')->label(__('High Quality'))->hint(__('High quality images take longer to generate.')),
                    ])
            ])
            ->statePath('data')
            ->model(Image::class);
    }

    public function create(): void
    {
        if (session('imagePath')) {
            Storage::disk('public')->delete(session('imagePath'));
            session()->forget('imagePath');
        }
        $this->imagePath = "";
        $this->fetching = true;
        $data = $this->form->getState();
        $checkpoint = Checkpoint::find($data['checkpoint_id']);
        $data['checkpoint'] = $checkpoint->fileName;
        $data['ksampler'] = [
            'steps' => $checkpoint->steps,
            'cfg' => $checkpoint->cfg,
            'sampler_name' => $checkpoint->sampler_name,
            'scheduler' => $checkpoint->scheduler
        ];

        // FIll the lora and embeddings with file names
        if (isset($data['loras'])) {
            for ($i = 0; $i < count($data['loras']); $i++) {
                $lora = Lora::find($data['loras'][$i]['lora_id']);
                $data['loras'][$i]['lora'] = $lora->fileName;
            }
        }

        if (isset($data['embeddings'])) {
            for ($i = 0; $i < count($data['embeddings']); $i++) {
                $embedding = Embedding::find($data['embeddings'][$i]['embedding_id']);
                $data['embeddings'][$i]['embedding'] = $embedding->fileName;
            }
        }

        $apiUrl = config('services.flask') . '/generate';
        //display jpeg response
        $response = Http::timeout(5 * 60)->post($apiUrl, $data);

        // display the image in the browser
        $image = $response->getBody();
        if ($response->status() !== 200) {
            return;
        }
        $this->imagePath = "images/tmp/" . Str::random(40) . ".png";
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
                TextInput::make('name')->label(__("Name"))
                    ->nullable()
                    ->maxLength(255),
                TextInput::make('description')->label(__("Description"))
                    ->nullable(),
                Select::make('tags')
                    ->multiple()
                    ->preload()
                    ->relationship('tags', 'name')
                    ->createOptionForm([
                        TextInput::make('name')->label(__("Name"))
                            ->required(),
                    ]),
                Checkbox::make('public')->label(trans_choice('Public', 0))
            ])
            ->model(Image::class)
            ->action(function (array $data): void {
                $this->saveImage($data);
            });
    }

    public function openRequestForm(): Action
    {
        return Action::make('openRequestForm')
            ->label(__('here'))
            ->modalHeading(__('Resource request'))
            ->form([
                TextInput::make('resource_name')
                    ->maxLength(255)->required()->label(__('Resource name')),
                TextInput::make('resource_url')->url()->required()->label(__('Resource url')),
                TextInput::make('resource_description')
                    ->nullable()->label(__('Resource description'))
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
        return view('livewire.pages.generate-image');
    }
}