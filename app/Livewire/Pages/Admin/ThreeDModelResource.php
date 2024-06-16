<?php

namespace App\Livewire\Pages\Admin;

use App\Models\ThreeDModel;
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
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;


class ThreeDModelResource extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;


    protected static ?string $model = ThreeDModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function table(Table $table): Table
    {
        return $table
            ->query(ThreeDModel::query())
            ->columns([
                TextColumn::make('name')->label(__("Name"))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('description')->label(__("Description"))
                    ->limit(20)
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('user.name')->label('User Name')
                    ->sortable(),
                TextColumn::make('path')
                    ->searchable()
                    ->limit(20)
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: false),
                ImageColumn::make('thumbnail')
                    ->disk(
                        fn(ThreeDModel $model) => $model->public ? 'public' : 'local'
                    ),
                IconColumn::make('public')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('name')->label(__("Name"))->label('Name'),
            ])
            ->actions([
                Action::make('View')
                    ->label('View model')
                    ->icon('heroicon-o-photo')
                    ->color('info')
                    ->action(
                        fn(ThreeDModel $threeDModel) => redirect()->away(config('services.angular') . "/{$threeDModel->id}")
                    ),
                EditAction::make()->form([
                    TextInput::make('name')->label(__("Name"))->nullable(),
                    Textarea::make('description')->label(__("Description"))->nullable(),
                    TextInput::make('prompt')->required(),
                    TextInput::make('path')->required(),
                    TextInput::make('thumbnail')->required(),
                    Toggle::make('public')
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

    public function render(): View
    {
        return view('livewire.pages.admin.three-d-model-resource');
    }
}
