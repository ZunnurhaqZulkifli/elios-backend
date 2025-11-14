<?php

namespace App\Filament\Resources\TaskTypes;

use App\Filament\Resources\TaskTypes\Pages\CreateTaskType;
use App\Filament\Resources\TaskTypes\Pages\EditTaskType;
use App\Filament\Resources\TaskTypes\Pages\ListTaskTypes;
use App\Filament\Resources\TaskTypes\Schemas\TaskTypeForm;
use App\Filament\Resources\TaskTypes\Tables\TaskTypesTable;
use App\Models\TaskType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class TaskTypeResource extends Resource
{
    protected static ?string $model = TaskType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static UnitEnum|string|null $navigationGroup = 'System Data';

    public static function form(Schema $schema): Schema
    {
        return TaskTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TaskTypesTable::configure($table);
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
            'index' => ListTaskTypes::route('/'),
            'create' => CreateTaskType::route('/create'),
            'edit' => EditTaskType::route('/{record}/edit'),
        ];
    }
}
