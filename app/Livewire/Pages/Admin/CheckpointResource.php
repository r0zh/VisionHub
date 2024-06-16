<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Checkpoint;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CheckpointResource extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;


    protected static ?string $model = Checkpoint::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function table(Table $table): Table
    {
        return $table
            ->query(Checkpoint::query())
            ->heading('Checkpoints')
            ->headerActions([
                Tables\Actions\CreateAction::make()->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)->label('Name'),
                    TextInput::make('fileName')
                        ->required()
                        ->maxLength(255)->label('Path'),
                    TextInput::make('description')
                        ->maxLength(255)->label('Description'),
                    TextInput::make('steps')
                        ->required(),
                    TextInput::make('cfg')
                        ->required()
                        ->numeric(),
                    Select::make('sampler_name')
                        ->options([
                            "euler",
                            "eurler_ancestral",
                            "dpmpp_sde",
                            "dpmpp_sde_gpu",
                            "dpmpp_2m",
                            "dpmpp_2m_gpu",
                            "dpmpp_2m_sde_gpu",
                            "dpmpp_2m_sde",
                            "dpmpp_2m_sde_gpu",
                            "lcm"
                        ])
                        ->required(),
                    Select::make('scheduler')
                        ->options([
                            "normal",
                            "karras",
                            "exponential",
                            "sgm_uniform",
                            "simple",
                            "ddim_uniform"
                        ])
                        ->required(),
                ]),
            ])
            ->columns([
                TextColumn::make('name')->label('Name')->searchable(),
                TextColumn::make('fileName')->label('Path'),
                TextColumn::make('description')->label('Description')->searchable(),
                TextColumn::make('steps')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('cfg')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('sampler_name')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('scheduler')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->form([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)->label('Name'),
                        TextInput::make('fileName')
                            ->required()
                            ->maxLength(255)->label('Path'),
                        TextInput::make('description')
                            ->maxLength(255)->label('Description'),
                        TextInput::make('steps')
                            ->required(),
                        TextInput::make('cfg')
                            ->required()
                            ->numeric(),
                        Select::make('sampler_name')
                            ->options([
                                "euler",
                                "eurler_ancestral",
                                "dpmpp_sde",
                                "dpmpp_sde_gpu",
                                "dpmpp_2m",
                                "dpmpp_2m_gpu",
                                "dpmpp_2m_sde_gpu",
                                "dpmpp_2m_sde",
                                "dpmpp_2m_sde_gpu",
                                "lcm"
                            ])
                            ->required(),
                        Select::make('scheduler')
                            ->options([
                                "normal",
                                "karras",
                                "exponential",
                                "sgm_uniform",
                                "simple",
                                "ddim_uniform"
                            ])
                            ->required(),
                    ]),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    public function render(): View
    {
        return view('livewire.pages.admin.checkpoint-resource');
    }
}
