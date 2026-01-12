<?php

namespace App\Livewire;

use App\Models\TaskAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;
use Livewire\Component;

class TaskActionDocuments extends Component implements HasForms
{
    use InteractsWithForms;

    public $record;

    public function render()
    {
        return view('livewire.task-action-documents');
    }

    public function mount($id): void
    {
        $this->record = TaskAction::find($id);
    }

    public function form(Schema $form): Schema
    {
        $action = $this->record;
        
        return $form
            ->schema(function () use ($action) {
                $data = [];

                $documents = $action->attachments;
                $count = count($documents ?? []);

                if ($documents == null) {
                    return [
                        TextEntry::make('document')
                            ->label('Tiada Dokumen')
                            ->columnSpanFull(),
                    ];
                } else {
                    foreach ($documents as $key => $document) {
                        $data[] = [
                            PdfViewerField::make('documentse')
                                ->fileUrl(fn() => Storage::url($document))
                                ->minHeight('20svh')
                                ->label('Dokumen ' . ($key + 1)),
                        ];
                    }
                }

                return [
                    Grid::make($count > 1 ? 2 : 1)->schema(array_merge(...$data))
                ];
            });
    }
}
