<?php

namespace App\Livewire\Admin;

use App\Models\Style;
use Filament\Forms\Components\TextInput;
use Livewire\Component;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;


class StyleAdminResource extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;


    protected static ?string $model = Style::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    
    public static function table(Table $table): Table
    {
        return $table
            ->query(Style::query())
            ->heading('Style')
            ->headerActions([
                Tables\Actions\CreateAction::make()->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)->label('Name')->required(),
                    Select::make('loras')
                        ->multiple()
                        ->preload()
                        ->relationship('loras', 'name'),
                    Select::make('checkpoint')
                        ->preload()
                        ->relationship('checkpoint', 'name')->required(),
                    Select::make('embedding')
                        ->preload()
                        ->relationship('embedding', 'name')
                    /* TextInput::make('description')
                        ->maxLength(255)->label('Description'), */
                ]),
            ])
            ->columns([
                TextColumn::make('name')->label('Name')->searchable(),
                //TextColumn::make('description')->label('Description')->searchable(),
                //TextColumn::make('loras.name')->label('Loras')->searchable(),
                TextColumn::make('checkpoint.name')->label('Checkpoint')->searchable(),
                TextColumn::make('embedding.name')->label('Embedding')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)->label('Name')->required(),
                    Select::make('loras')
                        ->multiple()
                        ->preload()
                        ->relationship('loras', 'name'),
                    Select::make('checkpoint')
                        ->preload()
                        ->relationship('checkpoint', 'name')->required(),
                    Select::make('embedding')
                        ->preload()
                        ->relationship('embedding', 'name')
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
        return view('livewire.admin.admin-style');
    }
}
