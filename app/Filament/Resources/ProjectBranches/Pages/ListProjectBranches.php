<?php

namespace App\Filament\Resources\ProjectBranches\Pages;

use App\Filament\Resources\ProjectBranches\ProjectBranchResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProjectBranches extends ListRecords
{
    protected static string $resource = ProjectBranchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
