<?php

namespace App\Filament\Resources\ModuleTests\Pages;

use App\Filament\Resources\ModuleTests\ModuleTestResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditModuleTest extends EditRecord
{
    protected static string $resource = ModuleTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
