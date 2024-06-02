<?php

namespace App\Livewire\Admin;

use App\Models\Lora;
use Filament\Forms\Components\TextInput;
use Livewire\Component;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;

class LoraAdminResource extends Component implements HasForms, HasTable
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
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)->label('Name'),
                    TextInput::make('fileName')
                        ->required()
                        ->maxLength(255)->label('Path'),
                    TextInput::make('description')
                        ->maxLength(255)->label('Description'),
                ]),
            ])
            ->columns([
                TextColumn::make('name')->label('Name')->searchable(),
                TextColumn::make('fileName')->label('Path'),
                TextColumn::make('description')->label('Description')->searchable(),
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
        return view('livewire.admin.admin-lora');
    }
}
