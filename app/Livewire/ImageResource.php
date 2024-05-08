<?php

namespace App\Livewire;

use App\Filament\Resources\TagResource\Pages;
use App\Filament\Resources\TagResource\RelationManagers;
use App\Models\Tag;
use App\Models\Image;
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

use Filament\Tables\Actions\Action;

class ImageResource extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static ?string $model = Image::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            
            ->schema([
                Section::make('Create Image')
                ->schema([
                    TextInput::make('name'),
                
                    Group::make()
                    ->schema([
                        Section::make('Tags')->schema([
                            
                            Select::make('tags')
                            ->multiple()
                            ->options(Tag::pluck('name', 'id')->toArray())
                        ])
                    ])
                ])
                
            ])
            ->actions(function () {
                return [
                    CreateAction::make('Create')
                        ->submit(),
                    
                    // Otros botones si los necesitas
                ];
            });
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Image::query())
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                /* Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]), */
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
        return [
            'index' => Pages\ListImages::route('/'),
            'create' => Pages\CreateImage::route('/create'),
            'edit' => Pages\EditImage::route('/{record}/edit'),
        ];
    }
    public function render(): View
    {
        
        return view('livewire.visionHub.forms.form-image');
        

        /* $form = Form::make(); // Crear el formulario
        $this->form($form); // Configurar el esquema del formulario

        return view('livewire.visionHub.forms.form-image', [
        'form' => $form->schema()->render(), // Renderizar el formulario
    ]); */
    }
}
