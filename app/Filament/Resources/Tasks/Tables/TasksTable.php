<?php

namespace App\Filament\Resources\Tasks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TasksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('taskable_type')
                    ->searchable(),
                TextColumn::make('taskable_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('assigned_by')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('type_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('level_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('file_name')
                    ->searchable(),
                TextColumn::make('assigner')
                    ->searchable(),
                TextColumn::make('suggested_date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('due_date')
                    ->dateTime()
                    ->sortable(),
                IconColumn::make('is_completed')
                    ->boolean(),
                TextColumn::make('completed_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('progress')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->searchable(),
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
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
