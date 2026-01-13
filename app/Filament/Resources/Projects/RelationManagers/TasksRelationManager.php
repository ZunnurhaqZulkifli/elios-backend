<?php

namespace App\Filament\Resources\Projects\RelationManagers;

use App\Filament\Resources\Tasks\TaskResource;
use App\Models\Task;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TasksRelationManager extends RelationManager
{
    protected static string $relationship = 'tasks';

    protected static ?string $relatedResource = TaskResource::class;

    protected function getTableQuery(): Builder
    {
        return $this->getOwnerRecord()->tasks();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                $query = Task::query()
                    ->where('taskable_type', 'App\Models\Project')
                    ->where('taskable_id', '=', $this->ownerRecord->id);

                return $query;
            })
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
