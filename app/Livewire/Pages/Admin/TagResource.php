<?php

namespace App\Livewire\Pages\Admin;

use App\Filament\Resources\TagResource\Pages;
use App\Filament\Resources\TagResource\RelationManagers;
use App\Models\Post;
use App\Models\Tag;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;


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
                    TextInput::make('name')->label(__("Name"))
                        ->required()
                        ->maxLength(255),
                ]),
            ])
            ->columns([
                TextColumn::make('name')->label(__("Name")),
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
                        TextInput::make('name')->label(__("Name"))
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
        return view('livewire.pages.admin.tags-resource');
    }
}
