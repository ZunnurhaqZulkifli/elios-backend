<?php

namespace App\Filament\Resources\ProjectBugSeverities\Pages;

use App\Filament\Resources\ProjectBugSeverities\ProjectBugSeverityResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProjectBugSeverity extends EditRecord
{
    protected static string $resource = ProjectBugSeverityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
