<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StoreResource\Pages;
use App\Filament\Resources\StoreResource\RelationManagers;
use App\Models\Store;
use Filament\Forms;
use Filament\Forms\Components as FormComponent;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components as InfolistComponent;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StoreResource extends Resource
{
    protected static ?string $model = Store::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FormComponent\Grid::make(6)
                    ->schema([
                        FormComponent\Section::make('')
                            ->schema([
                                FormComponent\TextInput::make('name')->columnSpanFull(),
                            ]),
                        FormComponent\Section::make('')
                            ->schema([
                                FormComponent\RichEditor::make('description'),
                                FormComponent\TextInput::make('store_location'),
                            ])->columnSpan(4),
                        FormComponent\Section::make('Status')
                            ->schema([
                                FormComponent\Toggle::make('is_active'),
                            ])->columnSpan(2),
                    ]),
            ])->statePath('data');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('description')
                    ->html()
                    ->limit(60),
                TextColumn::make('store_location'),
                ToggleColumn::make('is_active')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistComponent\Grid::make(6)
                    ->schema([
                    InfolistComponent\Group::make([
                        InfolistComponent\Section::make('Store Name')
                            ->schema([
                                InfolistComponent\TextEntry::make('name')
                                    ->label('Store Name: ')
                                    ->hiddenLabel()
                                    ->weight(FontWeight::Bold)
                                    ->size(TextEntrySize::Large),
                            ]),
                        InfolistComponent\Section::make('Details')
                            ->schema([
                                InfolistComponent\TextEntry::make('description')
                                    ->markdown(),
                            ])
                    ])->columnSpan(4),
                    InfolistComponent\Group::make([
                        InfolistComponent\Section::make('Other Details')
                            ->schema([
                                InfolistComponent\TextEntry::make('is_active')
                                    ->label('Store Status: ')
                                    ->inlineLabel()
                                    ->formatStateUsing(fn ($state) => $state ? 'Active' : 'In-active')
                                    ->badge()
                                    ->color(fn ($state) => $state ? 'success' : 'warning'),

                                InfolistComponent\TextEntry::make('store_location')
                                    ->inlineLabel()
                                    ->label('Location: '),
                            ])
                    ])->columnSpan(2)
                ])
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
            'index' => Pages\ListStores::route('/'),
            'create' => Pages\CreateStore::route('/create'),
            'edit' => Pages\EditStore::route('/{record}/edit'),
            'view' => Pages\ViewStore::route('/{record}/details'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->owner()
        ;
    }
}
