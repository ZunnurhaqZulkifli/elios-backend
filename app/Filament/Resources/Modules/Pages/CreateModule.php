<?php

namespace App\Filament\Resources\Modules\Pages;

use App\Filament\Resources\Modules\ModuleResource;
use App\Http\Controllers\BulkUploadController;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateModule extends CreateRecord
{
    protected static string $resource = ModuleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return parent::mutateFormDataBeforeCreate($data);
    }

    public function getHeaderActions(): array
    {
        return [
            Action::make('bulk-upload-template-download')
                ->label('Bulk Upload Template')
                ->url(route('bulk-uploads.excel', ['type' => 'modules']))
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
                    $totalRecords = $action->upload($data, 'modules');

                    Notification::make()->title('Successfully created' . $totalRecords . ' modules from bulk upload.')
                        ->success()
                        ->send();
                })
                ->icon('heroicon-o-archive-box-arrow-down'),
        ];
    }
}
