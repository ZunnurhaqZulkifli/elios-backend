<?php

namespace App\Filament\Resources\TaskTypes\Pages;

use App\Filament\Resources\TaskTypes\TaskTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTaskType extends CreateRecord
{
    protected static string $resource = TaskTypeResource::class;
}
