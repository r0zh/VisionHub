<?php

namespace App\Livewire\Pages\Moderator;

use App\Filament\Resources\TagResource\Pages;
use App\Models\ResourceRequest;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

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
                Tables\Columns\TextColumn::make('request_type')->label(__('Request Type'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('resource_name')->label(__('Resource Name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('resource_description')->label(__('Resource description')),
                Tables\Columns\TextColumn::make('resource_url')->label(__('Resource url'))
                    ->searchable()
                    ->state(function (ResourceRequest $record): string {
                        return "<a style='color: aqua' href='" . $record->resource_url . "'> " . $record->resource_url . " </a>";
                    })
                    ->html()
                ,
                Tables\Columns\TextColumn::make('status')->label(__('Status'))->state(function (ResourceRequest $record): string {
                    if ($record->status === 'pending')
                        return "<p style='color:yellow; font-weight: bold'>" . __("Pending") . "</p>";
                    else if ($record->status === 'approved')
                        return "<p style='color:green; font-weight: bold'>" . __("Approved") . "</p>";
                    else if ($record->status === 'rejected')
                        return "<p style='color:red; font-weight: bold'>" . __("Rejected") . "</p>";
                    else
                        return $record->status;
                })->html(),
                Tables\Columns\TextColumn::make('sender.name')->label(__('Sender'))->sortable(),
                Tables\Columns\TextColumn::make('approvedBy.name')->label(__('Resolved by'))->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label(__('Created At'))->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->label(__('Updated At'))->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label(__('Resolve'))
                    ->color('success')
                    ->form([
                        TextInput::make('request_type')->label(__('Request Type'))
                            ->disabled(),
                        TextInput::make('resource_name')->label(__('Resource Name'))
                            ->disabled(),
                        TextInput::make('resource_url')->label(__('Resource url'))
                            ->url()
                            ->disabled(),
                        TextInput::make('resource_description')->label(__('Resource description'))
                            ->disabled(),
                        Select::make('status')->label(__('Status'))
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
                        TextInput::make('request_type')->label(__('Request Type'))
                            ->disabled(),
                        TextInput::make('resource_name')->label(__('Resource Name'))
                            ->disabled(),
                        TextInput::make('resource_url')->label(__('Resource url'))
                            ->url()
                            ->disabled(),
                        TextInput::make('resource_description')->label(__('Resource description'))
                            ->disabled(),
                        Select::make('status')->label(__('Status'))
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
        return view('livewire.pages.moderator.resolve-request-resource');
    }
}
