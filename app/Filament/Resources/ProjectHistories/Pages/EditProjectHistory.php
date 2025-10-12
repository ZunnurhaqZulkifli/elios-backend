<?php

namespace App\Filament\Resources\ProjectHistories\Pages;

use App\Filament\Resources\ProjectHistories\ProjectHistoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProjectHistory extends EditRecord
{
    protected static string $resource = ProjectHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
