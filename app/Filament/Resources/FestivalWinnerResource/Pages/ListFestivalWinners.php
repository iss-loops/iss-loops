<?php

namespace App\Filament\Resources\FestivalWinnerResource\Pages;

use App\Filament\Resources\FestivalWinnerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFestivalWinners extends ListRecords
{
    protected static string $resource = FestivalWinnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
