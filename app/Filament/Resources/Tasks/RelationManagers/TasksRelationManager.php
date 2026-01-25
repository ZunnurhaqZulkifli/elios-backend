<?php

namespace App\Filament\Resources\Tasks\RelationManagers;

use App\Filament\Resources\Tasks\TaskResource;
use App\Models\Task;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class TasksRelationManager extends RelationManager
{
    protected static string $relationship = 'tasks';

    protected static ?string $relatedResource = TaskResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->query(function ($query) {
                $query = Task::query()
                    ->where('module_id', '=', $this->ownerRecord->id)
                    ->orderBy('progress', 'asc')
                    ->orderBy('id', 'asc');

                return $query;
            })
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
