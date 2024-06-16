<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Image;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;


class ImageResource extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;


    protected static ?string $model = Image::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function table(Table $table): Table
    {
        return $table
            ->query(Image::query())
            ->columns([
                TextColumn::make('name')->label(__("Name"))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('description')->label(__("Description"))
                    ->limit(20)
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('user.name')->label(__("User Name"))
                    ->sortable(),
                TextColumn::make('checkpoint.name')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('positivePrompt')->label(__('Positive Prompt'))
                    ->searchable()
                    ->limit(20)
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('negativePrompt')->label(__('Negative Prompt'))
                    ->searchable()
                    ->limit(20)
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('loras.name')
                    ->searchable()
                    ->limit(40)
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('embeddings.name')
                    ->searchable()
                    ->limit(40)
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('path')
                    ->searchable()
                    ->limit(20)
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('seed')->label(__('Seed'))
                    ->numeric()
                    ->sortable()
                    ->words(2)
                    ->toggleable(isToggledHiddenByDefault: false),
                IconColumn::make('public')->label(trans_choice('Public', 0))
                    ->boolean(),
                TextColumn::make('created_at')->label(__('Created At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->label(__('Updated At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('name')->label(__("Name")),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('View')
                    ->label(__('View image'))
                    ->icon('heroicon-o-photo')
                    ->color('info')
                    ->modalContent(
                        fn(Image $image): View => view(
                            'livewire.common.image-modal',
                            ['image' => $image],
                        )
                    )->modalSubmitAction(false)->modalCancelActionLabel(__('Close'))->modalWidth('fit')
                ,
                EditAction::make()->form([
                    TextInput::make('name')->label(__("Name"))->nullable(),
                    Textarea::make('description')->label(__("Description"))->nullable(),
                    Select::make('checkpoint_id')->preload()->relationship(name: 'checkpoint', titleAttribute: 'name')->required(),
                    TextInput::make('positivePrompt')->label(__('Positive Prompt'))->required(),
                    TextInput::make('negativePrompt')->label(__('Negative Prompt')),
                    TextInput::make('seed')->label(__('Seed'))->numeric()->required()->maxValue(4294967296)->minValue(0)->default(rand(1, 4294967296)),
                    Select::make('tags')
                        ->multiple()
                        ->preload()
                        ->relationship('tags', 'name')
                        ->createOptionForm([
                            TextInput::make('name')->label(__("Name"))
                                ->required(),
                        ]),
                    Repeater::make('loras')
                        ->relationship('imageLoras')
                        ->schema([
                            Select::make('lora_id')->relationship(name: 'lora', titleAttribute: 'name')->label(__('Lora name'))->required(),
                            TextInput::make(__('weight'))->numeric()->required()->maxValue(1.0)->minValue(-1.0)->step(0.01)->default(1),
                        ])
                        ->cloneable()
                        ->defaultItems(0)
                        ->columns(2),

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
                        ])
                        ->cloneable()
                        ->defaultItems(0)
                        ->columns(2),
                    Toggle::make('public')->label(trans_choice('Public', 0))
                        ->onColor('success')
                        ->offColor('danger')
                ]),
                DeleteAction::make()

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function openImageInfoModal($image)
    {
        $self = new self();
        $self->dispatch('imageSelected', image: $image);
        $self->dispatch('open-modal', ['id' => 'image-info-modal']);
    }

    public function render(): View
    {
        return view('livewire.pages.admin.image-resource');
    }
}
