<?php

namespace App\Filament\Resources\Tasks\RelationManagers;

use App\Actions\Tasks\TaskCalculateProgess;
use App\Enums\TaskStatusEnum;
use App\Filament\Resources\Tasks\TaskResource;
use App\Livewire\TaskActionDetails;
use App\Livewire\TaskActionDocuments;
use App\Models\TaskAction;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Schemas\Components\Livewire;
use Filament\Resources\RelationManagers\RelationManager;

class ActionsRelationManager extends RelationManager
{
    protected static string $relationship = 'actions';

    protected static ?string $relatedResource = TaskResource::class;

    protected static ?string $relationshipTitle = 'Task Actions';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                TaskAction::query()
                    ->where('task_id', $this->getOwnerRecord()->id)
            )
            ->columns([
                TextColumn::make('index')
                    ->label('No. ')
                    ->rowIndex(),

                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('title')
                    ->label('Title')
                    ->sortable()
                    ->wrap(),

                TextColumn::make('type')
                    ->label('Action Type')
                    ->sortable()
                    ->badge(),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->recordActions([

                Action::make('view-details')
                    ->label('Details')
                    ->schema(function ($record, $action) {
                        return [
                            Livewire::make(TaskActionDetails::class, [
                                'id' => $record->id,
                            ])
                                ->key('details')
                                ->lazy()
                        ];
                    })
                    ->icon('heroicon-o-eye'),

                Action::make('view-attachments')
                    ->label('Attachments')
                    ->schema(function ($record, $action) {
                        return [
                            Livewire::make(TaskActionDocuments::class, [
                                'id' => $record->id,
                            ])
                                ->key('documents')
                                ->lazy()
                        ];
                    })
                    ->icon('heroicon-o-paper-clip')
                    ->color('secondary'),

                ActionGroup::make([
                    Action::make('edit')
                        ->label('Edit')
                        ->schema([
                            Select::make('status')
                                ->label('Task Status')
                                ->options(TaskStatusEnum::options())
                                ->default(fn(TaskAction $record) => $record->task->status)
                                ->required(),

                            TextInput::make('title')
                                ->label('Action Title')
                                ->default(fn(TaskAction $record) => $record->title)
                                ->required()
                                ->maxLength(255),

                            MarkdownEditor::make('remarks')
                                ->label('Action Remarks')
                                ->default(fn(TaskAction $record) => $record->remarks)
                                ->required(),
                        ])
                        ->action(function (TaskAction $record, array $data) {
                            $record->update($data);

                            $record->task->update([
                                'status' => $data['status'],
                            ]);

                            TaskCalculateProgess::excecute($this->getOwnerRecord()->module);

                            Notification::make()
                                ->title('Task Action Updated')
                                ->success()
                                ->send();

                            $this->js('window.location.reload()');
                        })
                        ->icon('heroicon-o-pencil'),

                    Action::make('delete')
                        ->label('Delete')
                        ->requiresConfirmation()
                        ->action(function (TaskAction $record) {
                            $record->delete();

                            $module = $this->getOwnerRecord()->module;
                            TaskCalculateProgess::excecute($module);

                            Notification::make()
                                ->title('Task Action Deleted')
                                ->success()
                                ->send();

                            $this->js('window.location.reload()');
                        })
                        ->icon('heroicon-o-trash')
                        ->color('danger'),
                ])
            ])
            ->recordAction('view-details');
    }
}
