<?php

namespace App\Filament\Resources\ProjectBranches\Pages;

use App\Filament\Resources\ProjectBranches\ProjectBranchResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditProjectBranch extends EditRecord
{
    protected static string $resource = ProjectBranchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
