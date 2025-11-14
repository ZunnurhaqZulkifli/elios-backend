<?php

namespace App\Filament\Resources\Tasks;

use App\Enums\TaskStatusEnum;
use App\Filament\Resources\Tasks\Pages\CreateTask;
use App\Filament\Resources\Tasks\Pages\EditTask;
use App\Filament\Resources\Tasks\Pages\ListTasks;
use App\Filament\Resources\Tasks\Schemas\TaskForm;
use App\Filament\Resources\Tasks\Tables\TasksTable;
use App\Models\Task;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $recordTitleAttribute = 'title';

    protected static UnitEnum|string|null $navigationGroup = 'Tasks';

    protected static ?int $navigationSort = 1;

     public static function getModelLabel(): string
    {
        return 'Task';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Tasks';
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) static::$model::whereNotIn('status', [
            TaskStatusEnum::COMPLETED->value,
            TaskStatusEnum::CANCELLED->value,
        ])->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return Color::Amber;
    }

    public static function form(Schema $schema): Schema
    {
        return TaskForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TasksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTasks::route('/'),
            'create' => CreateTask::route('/create'),
            'edit' => EditTask::route('/{record}/edit'),
        ];
    }
}
