<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskProgressBar extends Component
{
    public Task $record;

    public function getProgressValue(): int
    {
        return $this->record->progress ?? 0;
    }

    public function render()
    {
        return view('livewire.task-progress-bar');
    }
}
