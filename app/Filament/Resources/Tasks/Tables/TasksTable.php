<?php

namespace App\Filament\Resources\Tasks\Tables;

use App\Actions\Tasks\TaskAction;
use App\Actions\Tasks\TaskNew;
use App\Actions\Tasks\TaskTesting;
use App\Enums\TaskActionTypeEnum;
use App\Enums\TaskStatusEnum;
use App\Filament\Tables\Columns\TaskProgressColumn;
use App\Models\CurrentProject;
use App\Models\Task;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class TasksTable
{
    public static function configure(Table $table): Table
    {
        $currentProject = CurrentProject::id();
        
        return $table
            ->query(function() use ($currentProject) {
                $squery = Task::query();

                if(!$currentProject) {
                    return $squery;
                }
                
                $query = $squery->whereHas('taskable', function ($query) use ($currentProject) {
                    $query->where('taskable_id', $currentProject);
                });

                return $query;
            })
            ->columns([
                TextColumn::make('index')
                    ->label('No. ')
                    ->rowIndex(),

                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('taskable_type')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('taskable_id')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('assigned_by')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('type_id')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('level_id')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('taskable.title')
                    ->label('Project / Owner')
                    ->description(fn (Task $record) => $record->taskable->ownerable->name),

                TextColumn::make('title')
                    ->label('Title / PIC')
                    ->description(fn (Task $record) => $record->taskable?->owner?->name ?? '-')
                    ->searchable(),

                TextColumn::make('file_name')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('assigner')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('suggested_date')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('due_date')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->searchable(),

                TaskProgressColumn::make('progress_bar')
                    ->label('Progress'),

                CheckboxColumn::make('is_completed')
                    ->label('Complete')
                    ->afterStateUpdated(function ($record, $state) {
                        if ($state) {
                            TaskTesting::handle($record);
                        } else {
                            TaskNew::handle($record);
                        }
                    }),

                TextColumn::make('completed_at')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                //
            ])
            ->recordAction('view')
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),

                    Action::make('do-task')
                        ->modalWidth(Width::ScreenExtraLarge)
                        ->accessSelectedRecords()
                        ->label('Do Tasks')
                        ->schema([
                            Select::make('status')
                                ->label('Task Status')
                                ->options(TaskStatusEnum::options())
                                ->required(),

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
                        ->modalSubmitActionLabel('Submit Task Action')
                        ->requiresConfirmation()
                        ->action(function (Collection $records, array $data) {

                            foreach ($records as $record) {
                                TaskAction::update($record, $data);
                            }

                            Notification::make()
                                ->title('Task updated successfully.')
                                ->success()
                                ->send();
                        })
                        ->icon('heroicon-o-pencil-square'),

                    Action::make('create-bug')
                        ->modalWidth(Width::ScreenExtraLarge)
                        ->accessSelectedRecords()
                        ->label('Do Tasks')
                        ->schema([
                            Select::make('status')
                                ->label('Task Status')
                                ->options(TaskStatusEnum::options())
                                ->required(),

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
                        ->modalSubmitActionLabel('Submit Task Action')
                        ->requiresConfirmation()
                        ->action(function (Collection $records, array $data) {

                            foreach ($records as $record) {
                                TaskAction::update($record, $data);
                            }

                            Notification::make()
                                ->title('Task updated successfully.')
                                ->success()
                                ->send();
                        })
                        ->icon('heroicon-o-pencil-square'),
                ]),
            ]);
    }
}
