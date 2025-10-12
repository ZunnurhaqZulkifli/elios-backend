<?php

namespace App\Filament\Resources\Individuals\Pages;

use App\Filament\Resources\Individuals\IndividualResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditIndividual extends EditRecord
{
    protected static string $resource = IndividualResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
