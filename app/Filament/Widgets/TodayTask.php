<?php

namespace App\Filament\Widgets;

use App\Actions\Tasks\TaskNew;
use App\Actions\Tasks\TaskTesting;
use App\Filament\Tables\Columns\TaskProgressColumn;
use App\Models\CurrentProject;
use App\Models\Task;
use Carbon\Carbon;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\CheckboxColumn;

class TodayTask extends TableWidget
{
    protected static null|string $heading = 'To Do`s';

    protected int | string | array $columnSpan = [
        'md' => 6, // 6 columns on medium devices
        'xl' => 12, // 12 columns (full width) on extra-large devices
    ];

    public $day;
    public $project_id;

    public function mount(&$day): void
    {
        $this->project_id = CurrentProject::id();
        $this->day = $day;
    }

    public function table(Table $table): Table
    {
        $year = now()->year;
        $month = now()->month;
        $date = Carbon::create($year, $month, $this->day);

        $query = Task::whereDate('suggested_date', $date);

        if ($this->project_id) {
            $query->whereHasMorph('taskable', '*', function (Builder $query) {
                $query->where('taskable_id', $this->project_id);
            });
        }

        return $table
            ->query(fn(): Builder => $query)
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
                    ->label('hours')
                    ->time()
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
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ])
            ->recordUrl(fn(Task $record): string => route('filament.admin.resources.tasks.view', $record));;
    }
}
