<?php

namespace App\Filament\Resources\ModuleTaskTemplates\Pages;

use App\Filament\Resources\ModuleTaskTemplates\ModuleTaskTemplateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListModuleTaskTemplates extends ListRecords
{
    protected static string $resource = ModuleTaskTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
