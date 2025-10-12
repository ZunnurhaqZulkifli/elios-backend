<?php

namespace App\Filament\Resources\ProjectBugs\Pages;

use App\Filament\Resources\ProjectBugs\ProjectBugResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProjectBugs extends ListRecords
{
    protected static string $resource = ProjectBugResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
