<?php

namespace App\Filament\Resources\Tasks\Tables;

use App\Actions\Tasks\TaskNew;
use App\Actions\Tasks\TaskTesting;
use App\Filament\Tables\Columns\TaskProgressColumn;
use App\Models\CurrentProject;
use App\Models\Project;
use App\Models\Task;
use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Schemas\Components\Livewire;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

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
                    ->label('Project'),

                TextColumn::make('title')
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
                ]),
            ]);
    }
}
