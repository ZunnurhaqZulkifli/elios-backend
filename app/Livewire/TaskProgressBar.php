<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class TaskProgressBar extends Component
{
    public Model $record;

    public function getProgressValue(): int
    {
        return $this->record->progress ?? 0;
    }

    public function render()
    {
        return view('livewire.task-progress-bar');
    }
}
