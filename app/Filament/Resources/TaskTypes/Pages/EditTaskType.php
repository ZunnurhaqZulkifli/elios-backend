<?php

namespace App\Filament\Resources\TaskTypes\Pages;

use App\Filament\Resources\TaskTypes\TaskTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTaskType extends EditRecord
{
    protected static string $resource = TaskTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
