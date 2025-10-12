<?php

namespace App\Filament\Resources\Postcodes\Pages;

use App\Filament\Resources\Postcodes\PostcodeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPostcodes extends ListRecords
{
    protected static string $resource = PostcodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
