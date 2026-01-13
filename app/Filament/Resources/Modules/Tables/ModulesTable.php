<?php

namespace App\Filament\Resources\Modules\Tables;

use App\Filament\Tables\Columns\TaskProgressColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use App\Models\CurrentProject;
use Filament\Tables\Table;
use App\Models\Module;

class ModulesTable
{
    public static function configure(Table $table): Table
    {
        $currentProject = CurrentProject::id();

        return $table
            ->query(function() use ($currentProject) {
                $squery = Module::query();

                if(!$currentProject) {
                    return $squery;
                }

                $query = $squery->whereHas('project', function ($query) use ($currentProject) {
                    $query->where('id', $currentProject);
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

                TextColumn::make('status')
                    ->searchable()
                    ->badge(),

                TextColumn::make('title')
                    ->searchable(),

                TextColumn::make('project.title')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),

                TextColumn::make('type.name')
                    ->sortable(),

                TextColumn::make('estimated_duration')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),

                TextColumn::make('total_duration')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),

                TaskProgressColumn::make('progress_bar')
                    ->label('Progress'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('deleted_at')
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
