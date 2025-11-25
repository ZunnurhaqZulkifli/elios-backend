<?php

namespace App\Filament\Tables\Columns;

use App\Models\Task;
use Closure;
use Filament\Tables\Columns\Column;
use Illuminate\Database\Eloquent\Model;

class TaskProgressColumn extends Column
{
    protected string $view = 'filament.tables.columns.task-progress-column';

    public function getProgressValue(): mixed
    {
        // Get the current record (Task model)
        $record = $this->getRecord();

        // Return the progress value from the record
        return $record->progress ?? 0;
    }
}
