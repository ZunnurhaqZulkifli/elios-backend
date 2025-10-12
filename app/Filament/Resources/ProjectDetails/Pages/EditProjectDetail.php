<?php

namespace App\Filament\Resources\ProjectDetails\Pages;

use App\Filament\Resources\ProjectDetails\ProjectDetailResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProjectDetail extends EditRecord
{
    protected static string $resource = ProjectDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
