<?php

namespace App\Filament\Resources\Tasks\Pages;

use App\Filament\Resources\Tasks\TaskResource;
use App\Http\Controllers\BulkUploadController;
use App\Models\Project;
use App\Models\Task;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateTask extends CreateRecord
{
    protected static string $resource = TaskResource::class;

    public function mount(): void
    {
        parent::mount();

        $this->form->fill([
            'taskable_type' => request('taskable_type', Project::class),
            'taskable_id' => request('taskable_id', 1), // Example ID
        ]);
    }

    public function getHeaderActions(): array
    {
        return [
            Action::make('bulk-upload-template-download')
                ->label('Bulk Upload Template')
                ->url(route('bulk-uploads.excel', ['type' => 'tasks']))
                ->icon('heroicon-o-archive-box-arrow-down'),

            Action::make('bulk-upload')
                ->label('Upload Tasks')
                ->schema([
                    FileUpload::make('bulk_upload_file')
                        ->label('Select Excel File')
                        ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'])
                        ->disk('public')
                        ->directory('bulk_uploads')
                        ->required(),
                ])
                ->action(function (array $data) {
                    $action = new BulkUploadController();
                    $totalRecords = $action->upload($data, 'tasks');

                    Notification::make()->title('Successfully created' . $totalRecords . ' tasks from bulk upload.')
                        ->success()
                        ->send();
                })
                ->icon('heroicon-o-archive-box-arrow-down'),
        ];
    }
}
