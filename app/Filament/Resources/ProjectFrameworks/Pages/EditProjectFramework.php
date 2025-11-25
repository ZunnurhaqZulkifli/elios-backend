<?php

namespace App\Filament\Resources\ProjectFrameworks\Pages;

use App\Filament\Resources\ProjectFrameworks\ProjectFrameworkResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditProjectFramework extends EditRecord
{
    protected static string $resource = ProjectFrameworkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
