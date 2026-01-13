<?php

namespace App\Filament\Resources\Projects\RelationManagers;

use App\Filament\Resources\ProjectHistories\ProjectHistoryResource;
use App\Models\Project;
use App\Models\ProjectHistory;
use App\Models\Task;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class HistoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'histories';

    protected static ?string $relatedResource = ProjectHistoryResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                $projectIds = [$this->ownerRecord->id];
                $taskIds = $this->ownerRecord->tasks()->pluck('id')->toArray();

                return ProjectHistory::query()
                    ->where(function ($query) use ($projectIds) {
                        $query->where('historable_type', Project::class)
                            ->whereIn('historable_id', $projectIds);
                    })
                    ->orWhere(function ($query) use ($taskIds) {
                        $query->where('historable_type', Task::class)
                            ->whereIn('historable_id', $taskIds);
                    });
            })
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
