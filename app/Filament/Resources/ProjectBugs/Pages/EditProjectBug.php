<?php

namespace App\Filament\Resources\ProjectBugs\Pages;

use App\Filament\Resources\ProjectBugs\ProjectBugResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProjectBug extends EditRecord
{
    protected static string $resource = ProjectBugResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
