<?php

namespace App\Filament\Resources\TaskLevels;

use App\Filament\Resources\TaskLevels\Pages\CreateTaskLevel;
use App\Filament\Resources\TaskLevels\Pages\EditTaskLevel;
use App\Filament\Resources\TaskLevels\Pages\ListTaskLevels;
use App\Filament\Resources\TaskLevels\Schemas\TaskLevelForm;
use App\Filament\Resources\TaskLevels\Tables\TaskLevelsTable;
use App\Models\TaskLevel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class TaskLevelResource extends Resource
{
    protected static ?string $model = TaskLevel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static UnitEnum|string|null $navigationGroup = 'System Data';

    public static function form(Schema $schema): Schema
    {
        return TaskLevelForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TaskLevelsTable::configure($table);
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
            'index' => ListTaskLevels::route('/'),
            'create' => CreateTaskLevel::route('/create'),
            'edit' => EditTaskLevel::route('/{record}/edit'),
        ];
    }
}
