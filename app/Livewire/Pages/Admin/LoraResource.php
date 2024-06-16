<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Lora;
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

class LoraResource extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;


    protected static ?string $model = Lora::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function table(Table $table): Table
    {
        return $table
            ->query(Lora::query())
            ->heading('Loras')
            ->headerActions([
                Tables\Actions\CreateAction::make()->form([
                    TextInput::make('name')->label(__("Name"))
                        ->required()
                        ->maxLength(255),
                    TextInput::make('fileName')
                        ->required()
                        ->maxLength(255)->label('Path'),
                    TextInput::make('description')->label(__("Description"))
                        ->maxLength(255),
                ]),
            ])
            ->columns([
                TextColumn::make('name')->label(__("Name"))->searchable(),
                TextColumn::make('fileName')->label('Path'),
                TextColumn::make('description')->label(__("Description"))->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->form([
                        TextInput::make('name')->label(__("Name"))
                            ->required()
                            ->maxLength(255),
                        TextInput::make('fileName')
                            ->required()
                            ->maxLength(255)->label('Path'),
                        TextInput::make('description')->label(__("Description"))
                            ->maxLength(255),
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
        return view('livewire.pages.admin.lora-resource');
    }
}
