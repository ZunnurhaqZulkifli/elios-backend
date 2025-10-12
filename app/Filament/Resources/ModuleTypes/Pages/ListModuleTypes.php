<?php

namespace App\Filament\Resources\ModuleTypes\Pages;

use App\Filament\Resources\ModuleTypes\ModuleTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListModuleTypes extends ListRecords
{
    protected static string $resource = ModuleTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
