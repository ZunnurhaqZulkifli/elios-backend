<?php

namespace App\Filament\Resources\ProjectFrameworks\Pages;

use App\Filament\Resources\ProjectFrameworks\ProjectFrameworkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProjectFrameworks extends ListRecords
{
    protected static string $resource = ProjectFrameworkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
