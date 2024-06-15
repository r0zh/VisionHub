<?php

namespace App\Livewire\Moderator;

use App\Models\ResourceRequest;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use App\Filament\Resources\TagResource\Pages;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class ResolveRequestResource extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static ?string $model = ResourceRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function table(Table $table): Table
    {

        return $table
            ->query(ResourceRequest::query())
            ->columns([
                Tables\Columns\TextColumn::make('request_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('resource_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('resource_url')
                    ->searchable()
                    ->state(function (ResourceRequest $record): string {
                        return "<a style='color: aqua' href='" . $record->resource_url . "'> Source </a>";
                    })
                    ->html()
                ,
                Tables\Columns\TextColumn::make('status')->state(function (ResourceRequest $record): string {
                    if ($record->status === 'pending')
                        return "<p style='color:yellow; font-weight: bold'>Pending</p>";
                    else if ($record->status === 'approved')
                        return "<p style='color:green; font-weight: bold'>Approved</p>";
                    else if ($record->status === 'rejected')
                        return "<p style='color:red; font-weight: bold'>Rejected</p>";
                    else
                        return $record->status;
                })->html(),
                Tables\Columns\TextColumn::make('sender_id')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('resolved_by')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Resolve')
                    ->color('success')
                    ->form([
                        TextInput::make('request_type')
                            ->disabled(),
                        TextInput::make('resource_name')
                            ->disabled(),
                        TextInput::make('resource_url')
                            ->url()
                            ->disabled(),
                        TextInput::make('resource_description')
                            ->disabled(),
                        TextInput::make('sender_id')
                            ->required()
                            ->maxLength(255)
                            ->disabled(),
                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->required(),
                    ])
                    ->action(function (ResourceRequest $record, $data) {
                        $record->status = $data['status'];
                        $record->resolved_by = auth()->id();
                        $record->save();
                    })
                    ->visible(function ($record) {
                        return $record->resolved_by === null;
                    }),
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->form([
                        TextInput::make('request_type')
                            ->disabled(),
                        TextInput::make('resource_name')
                            ->disabled(),
                        TextInput::make('resource_url')
                            ->url()
                            ->disabled(),
                        TextInput::make('resource_description')
                            ->disabled(),
                        TextInput::make('sender_id')
                            ->required()
                            ->maxLength(255)
                            ->disabled(),
                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->required(),
                    ])
                    ->action(function (ResourceRequest $record, $data) {
                        $record->status = $data['status'];
                        $record->resolved_by = auth()->id();
                        $record->save();
                    }),
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
        return view('livewire.common.resolve-request');
    }
}
