<?php

namespace App\Filament\Resources\ModuleTaskTemplates\Pages;

use App\Filament\Resources\ModuleTaskTemplates\ModuleTaskTemplateResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditModuleTaskTemplate extends EditRecord
{
    protected static string $resource = ModuleTaskTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
