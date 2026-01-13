<?php

namespace App\Filament\Resources\Tasks\Pages;

use App\Enums\TaskActionTypeEnum;
use App\Enums\TaskStatusEnum;
use App\Filament\Resources\Tasks\TaskResource;
use App\Livewire\TaskProgressBar;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\FontWeight;
use Illuminate\Database\Eloquent\Model;
use Filament\Support\Enums\Width;
use Illuminate\Support\Facades\Storage;
use Filament\Schemas\Components\Livewire as FilamentLivewire;
use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;

class ViewTask extends ViewRecord
{
    protected static string $resource = TaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),


            Action::make('do-task')
                ->modalWidth(Width::ScreenExtraLarge)
                ->visible(fn() => in_array($this->record->status->value, [
                    'in_progress',
                    'new',
                    'completed',
                ]))
                ->schema(
                    fn(Schema $schema) => $schema->components([
                        Select::make('status')
                            ->label('Task Status')
                            ->options(TaskStatusEnum::options())
                            ->default($this->record->status->value)
                            ->required(),

                        Textarea::make('remarks')
                            ->default($this->record->remarks)
                            ->label('Task Details')
                            ->disabled()
                            ->required(),

                        Section::make('Task Attachments')
                            ->icon('heroicon-o-paper-clip')
                            ->schema(function () {
                                $data = [];

                                $documents = $this->record->attachments;
                                $count = count($documents ?? []);

                                if ($documents == null) {
                                    return [
                                        TextEntry::make('document')
                                            ->label('Tiada Dokumen')
                                            ->columnSpanFull(),
                                    ];
                                } else {
                                    foreach ($documents as $key => $document) {
                                        $data[] =
                                            PdfViewerField::make('attachment ' . $key)
                                            ->label('Attachment ' . ($key + 1))
                                            ->fileUrl(Storage::url($document))
                                            ->minHeight('20svh')
                                            ->lazy();
                                    }
                                }

                                return [
                                    Grid::make($count > 1 ? 2 : 1)->schema($data)
                                ];
                            })
                            ->columns(1)
                            ->columnSpanFull(),

                        TextInput::make('file_name')
                            ->hint('UserController.php'),

                        Section::make('Task Action')
                            ->schema([
                                TextInput::make('action_title')
                                    ->label('Action Title')
                                    ->required(),

                                Select::make('action_type')
                                    ->label('Action Type')
                                    ->options(TaskActionTypeEnum::options())
                                    ->required(),

                                MarkdownEditor::make('action_remarks')
                                    ->label('Solution / Action Taken')
                                    ->required(),

                                FileUpload::make('action_attachments')
                                    ->label('Attachments')
                                    ->disk('public')
                                    ->directory('task/attachments')
                                    ->multiple(),
                            ])
                            ->columns(1)
                    ])
                )
                ->modalSubmitActionLabel('Submit Task Action')
                ->requiresConfirmation()
                ->action(function ($record, array $data) {
                    // TaskAction::update($record, $data);

                    Notification::make()
                        ->title('Task updated successfully.')
                        ->success()
                        ->send();

                    $this->js("window.location.reload();");
                })
                ->label($this->record->status->actionLabel())
                ->color($this->record->status->actionColor())
                ->extraAttributes([
                    'class' => '!text-white [&_svg]:text-white',
                ])
                ->icon('heroicon-o-check-circle'),

            ActionGroup::make([
                Action::make('view-project')
                    ->label('View Project')
                    ->url(fn(Model $record) => $record->taskable ? route('filament.admin.resources.projects.view', $record->taskable_id) : '#')
                    ->disabled(fn(Model $record) => !$record->taskable)
                    ->visible(fn(Model $record) => $record->taskable_id !== null && $record->taskable_type === \App\Models\Project::class)
                    ->icon('heroicon-o-link')
                    ->color(Color::Amber)
                    ->extraAttributes([
                        'class' => '!text-white [&_svg]:text-white',
                    ]),

                Action::make('view-module')
                    ->label('View Module')
                    ->url(fn(Model $record) => $record->taskable ? route('filament.admin.resources.modules.view', $record->module_id) : '#')
                    ->disabled(fn(Model $record) => !$record->taskable)
                    ->visible(fn(Model $record) => $record->module_id !== null)
                    ->icon('heroicon-o-link')
                    ->color(Color::Green)
                    ->extraAttributes([
                        'class' => '!text-white [&_svg]:text-white',
                    ]),
            ]),
        ];
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Task Details')
                    ->description('Main task information')
                    ->icon('heroicon-o-clipboard-document-check')
                    ->schema([
                        FilamentLivewire::make(TaskProgressBar::class, ['record' => $this->record])
                            ->columnSpanFull(),

                        TextEntry::make('title')
                            ->label('Task Title')
                            ->size('lg')
                            ->weight(FontWeight::Bold)
                            ->icon('heroicon-o-document-text')
                            ->iconColor('primary')
                            ->columnSpanFull(),

                        TextEntry::make('remarks')
                            ->label('Remarks')
                            ->markdown()
                            ->columnSpanFull()
                            ->placeholder('No remarks'),

                        TextEntry::make('status')
                            ->badge()
                            ->size('lg'),

                        TextEntry::make('is_completed')
                            ->label('Completed')
                            ->badge()
                            ->formatStateUsing(fn($state) => $state ? 'Yes' : 'No')
                            ->color(fn($state) => $state ? 'success' : 'gray'),

                        Section::make('Attachments')
                            ->icon('heroicon-o-paper-clip')
                            ->schema(function () {
                                $data = [];

                                $documents = $this->record->attachments;
                                $count = count($documents ?? []);

                                if ($documents == null) {
                                    return [
                                        TextEntry::make('document')
                                            ->label('Tiada Dokumen')
                                            ->columnSpanFull(),
                                    ];
                                } else {
                                    foreach ($documents as $key => $document) {
                                        $data[] = 
                                            PdfViewerField::make('attachment ' . $key)
                                                ->label('Attachment ' . ($key + 1))
                                                ->fileUrl(Storage::url($document))
                                                ->minHeight('20svh')
                                                ->lazy();
                                    }
                                }

                                return [
                                    Grid::make($count > 1 ? 2 : 1)->schema($data)
                                ];
                            })
                            ->columns(1)
                            ->columnSpanFull(),

                        // TextEntry::make('progress')
                        //     ->label('Progress')
                        //     ->suffix('%')
                        //     ->badge()
                        //     ->color(fn($state) => match (true) {
                        //         $state >= 100  => 'success',
                        //         $state >= 75   => 'info',
                        //         $state >= 50   => 'warning',
                        //         default => 'danger',
                        //     }),
                    ])
                    ->columns(2)
                    ->columnSpan(2),

                Section::make('Assignment')
                    ->icon('heroicon-o-user-group')
                    ->schema([
                        TextEntry::make('assignedBy.name')
                            ->label('Assigned By')
                            ->icon('heroicon-o-user')
                            ->iconColor('primary')
                            ->placeholder('Not set'),

                        TextEntry::make('personInCharge.name')
                            ->label('Person in Charge')
                            ->icon('heroicon-o-user-circle')
                            ->iconColor('success')
                            ->placeholder('Not assigned'),

                        TextEntry::make('task')
                            ->label('Task Type')
                            ->badge()
                            ->color('info')
                            ->placeholder('Not set'),

                        TextEntry::make('level.name')
                            ->label('Priority Level')
                            ->badge()
                            ->color('warning')
                            ->placeholder('Not set'),
                    ])
                    ->columns(1),

                Grid::make()
                    ->columns(1)
                    ->schema([
                        Section::make('Schedule')
                            ->icon('heroicon-o-calendar')
                            ->schema([
                                TextEntry::make('suggested_date')
                                    ->label('Suggested Date')
                                    ->dateTime()
                                    ->icon('heroicon-o-calendar-days')
                                    ->iconColor('info')
                                    ->placeholder('Not set'),

                                TextEntry::make('due_date')
                                    ->label('Due Date')
                                    ->dateTime()
                                    ->icon('heroicon-o-clock')
                                    ->iconColor('warning')
                                    ->color(
                                        fn($state, $record) =>
                                        $state && $state < now() && !$record->is_completed
                                            ? 'danger'
                                            : 'primary'
                                    )
                                    ->placeholder('No deadline'),

                                TextEntry::make('completed_at')
                                    ->label('Completed At')
                                    ->dateTime()
                                    ->icon('heroicon-o-check-circle')
                                    ->iconColor('success')
                                    ->placeholder('Not completed'),
                            ])
                            ->columns(1),

                        Section::make('System Information')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextEntry::make('id')
                                    ->label('Task ID')
                                    ->badge()
                                    ->color('gray'),

                                TextEntry::make('created_at')
                                    ->label('Created At')
                                    ->dateTime()
                                    ->icon('heroicon-o-calendar'),

                                TextEntry::make('updated_at')
                                    ->label('Last Updated')
                                    ->dateTime()
                                    ->since()
                                    ->icon('heroicon-o-clock'),
                            ])
                            ->columns(2)
                            ->collapsed(),
                    ])
                    ->columnSpan(1),

                Section::make('Related Information')
                    ->collapsed()
                    ->icon('heroicon-o-link')
                    ->schema([
                        TextEntry::make('taskable_type')
                            ->label('Related To')
                            ->formatStateUsing(fn($state) => $state ? class_basename($state) : 'N/A'),

                        TextEntry::make('taskable.title')
                            ->label('Related Item')
                            ->icon('heroicon-o-folder')
                            ->placeholder('Not linked'),

                        TextEntry::make('file_name')
                            ->label('Attached File')
                            ->icon('heroicon-o-paper-clip')
                            ->placeholder('No file'),
                    ])
                    ->columns(1)
                    ->columnSpan(2),
            ]);
    }
}
