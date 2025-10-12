<?php

namespace App\Filament\Resources\TaskLevels\Pages;

use App\Filament\Resources\TaskLevels\TaskLevelResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTaskLevel extends EditRecord
{
    protected static string $resource = TaskLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
