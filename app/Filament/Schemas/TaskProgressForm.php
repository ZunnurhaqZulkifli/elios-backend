<?php

namespace App\Filament\Schemas;

use App\Enums\ProjectPhaseEnum;
use App\Enums\TaskStatusEnum;
use App\Models\Task;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TaskProgressForm extends Schema
{
    public $record;

    protected string $view = 'filament.schemas.task-progress-form';

    public function mount($id): void
    {
        $this->record = Task::find($id);
    }

    public function getProgressValue(): mixed
    {
        // Get the current record (Task model)
        $record = $this->record;

        // Return the progress value from the record
        return $record->progress ?? 0;
    }
}
