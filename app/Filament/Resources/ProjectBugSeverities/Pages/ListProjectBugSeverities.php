<?php

namespace App\Filament\Resources\ProjectBugSeverities\Pages;

use App\Filament\Resources\ProjectBugSeverities\ProjectBugSeverityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProjectBugSeverities extends ListRecords
{
    protected static string $resource = ProjectBugSeverityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
