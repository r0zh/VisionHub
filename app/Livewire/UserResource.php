<?php

namespace App\Livewire;

use App\Filament\Resources\TagResource\Pages;
use App\Filament\Resources\TagResource\RelationManagers;
use App\Models\Tag;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\CreateAction;
use Filament\Forms\Components\Button;
use Filament\Resources\Resource;
use Livewire\Component;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;

class UserResource extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(User::query())
            ->headerActions([
                Tables\Actions\CreateAction::make()->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('password')
                        ->required()
                        ->maxLength(255),
                        
                ]),
            ])
            ->columns([
                TextColumn::make('name')->label('User Name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('password')
                        ->required()
                        ->maxLength(255)->label('New password')
                    ]),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        /* return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ]; */
    }
    public function render(): View
    {
        return view('livewire.visionHub.lists.list-user');
    }
}
