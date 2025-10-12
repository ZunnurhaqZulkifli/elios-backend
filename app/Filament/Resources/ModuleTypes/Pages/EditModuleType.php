<?php

namespace App\Filament\Resources\ModuleTypes\Pages;

use App\Filament\Resources\ModuleTypes\ModuleTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditModuleType extends EditRecord
{
    protected static string $resource = ModuleTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
