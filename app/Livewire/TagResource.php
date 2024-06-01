<?php

namespace App\Livewire;

use App\Filament\Resources\TagResource\Pages;
use App\Filament\Resources\TagResource\RelationManagers;
use App\Models\Tag;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Livewire\Component;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Contracts\View\View;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use App\Models\Post;
use Filament\Tables\Actions\Action;


class TagResource extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static ?string $model = Tag::class;

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
            ->query(Tag::query())
            ->headerActions([
                Tables\Actions\CreateAction::make()->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                ]),
            ])
            ->columns([
                TextColumn::make('name'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                /* Action::make('relatedPost')
                    ->label('View Related Posts')
                    ->url(fn (): string => route('posts.edit', ['name'])), */
                Tables\Actions\EditAction::make()
                ->form([
                    TextInput::make('name')
                        ->required()
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        
        return [
            'index' => Pages\ListTags::route('/admin/tags/lists'),
            'create' => Pages\CreateTag::route('/create'),
            'edit' => Pages\EditTag::route('/{record}/edit'),
        ];
    }
    public function render(): View
    {
        return view('livewire.visionHub.lists.list-tags');
    }
}
