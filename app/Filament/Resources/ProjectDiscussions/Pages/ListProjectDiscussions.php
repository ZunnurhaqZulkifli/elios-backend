<?php

namespace App\Filament\Resources\ProjectDiscussions\Pages;

use App\Filament\Resources\ProjectDiscussions\ProjectDiscussionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProjectDiscussions extends ListRecords
{
    protected static string $resource = ProjectDiscussionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
