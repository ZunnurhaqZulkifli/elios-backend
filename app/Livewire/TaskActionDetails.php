<?php

namespace App\Livewire;

use App\Models\TaskAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class TaskActionDetails extends Component implements HasForms
{
    use InteractsWithForms;

    public $record;

    public function render()
    {
        return view('livewire.task-action-details');
    }

    public function mount($id): void
    {
        $this->record = TaskAction::find($id);
    }

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextEntry::make('title')
                            ->default($this->record->title)
                            ->label('Title')
                            ->disabled(),

                        TextEntry::make('type')
                            ->default($this->record->type->getLabel())
                            ->label('Action Type')
                            ->disabled()
                            ->badge(),
                    ]),

                Section::make('Actions')
                    ->schema([
                        TextEntry::make('remarks')
                            ->default($this->record->remarks)
                            ->label('Remarks')
                            ->columnSpanFull()
                            ->markdown()
                            ->wrap(),
                    ]),
            ]);
    }
}
