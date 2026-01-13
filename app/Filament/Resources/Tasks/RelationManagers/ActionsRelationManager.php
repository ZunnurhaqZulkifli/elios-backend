<?php

namespace App\Filament\Resources\Tasks\RelationManagers;

use App\Actions\Modules\ModuleCalculateProgess;
use App\Actions\Tasks\TaskCalculateProgess;
use App\Filament\Resources\Tasks\TaskResource;
use App\Livewire\TaskActionDetails;
use App\Livewire\TaskActionDocuments;
use App\Models\TaskAction;
use Dom\Text;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Schemas\Components\Livewire;

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

                Action::make('delete')
                    ->label('Delete')
                    ->requiresConfirmation()
                    ->action(function(TaskAction $record) {
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
            ]);
    }
}
