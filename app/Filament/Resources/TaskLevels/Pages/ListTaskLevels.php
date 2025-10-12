<?php

namespace App\Filament\Resources\TaskLevels\Pages;

use App\Filament\Resources\TaskLevels\TaskLevelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTaskLevels extends ListRecords
{
    protected static string $resource = TaskLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
