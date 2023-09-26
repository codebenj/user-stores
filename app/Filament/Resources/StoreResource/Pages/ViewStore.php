<?php

namespace App\Filament\Resources\StoreResource\Pages;

use App\Filament\Resources\StoreResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;

class ViewStore extends ViewRecord
{
    protected static string $resource = StoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('edit')
                ->icon('heroicon-o-pencil-square')
                ->url(self::$resource::getUrl('edit', ['record' => $this->record])),
            Action::make('delete')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->requiresConfirmation()
                ->action(fn () => $this->record->delete()),
            Action::make('back')
                ->icon('heroicon-o-arrow-uturn-left')
                ->color('gray')
                ->url(self::$resource::getUrl('index')),
        ];
    }
}
