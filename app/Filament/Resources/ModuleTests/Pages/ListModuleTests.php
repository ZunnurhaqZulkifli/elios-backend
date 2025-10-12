<?php

namespace App\Filament\Resources\ModuleTests\Pages;

use App\Filament\Resources\ModuleTests\ModuleTestResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListModuleTests extends ListRecords
{
    protected static string $resource = ModuleTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
