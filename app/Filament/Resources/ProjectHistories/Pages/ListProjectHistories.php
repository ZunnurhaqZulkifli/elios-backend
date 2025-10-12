<?php

namespace App\Filament\Resources\ProjectHistories\Pages;

use App\Filament\Resources\ProjectHistories\ProjectHistoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProjectHistories extends ListRecords
{
    protected static string $resource = ProjectHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
