<?php

namespace App\Filament\Resources\ModuleTypes;

use App\Filament\Resources\ModuleTypes\Pages\CreateModuleType;
use App\Filament\Resources\ModuleTypes\Pages\EditModuleType;
use App\Filament\Resources\ModuleTypes\Pages\ListModuleTypes;
use App\Filament\Resources\ModuleTypes\Schemas\ModuleTypeForm;
use App\Filament\Resources\ModuleTypes\Tables\ModuleTypesTable;
use App\Models\ModuleType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ModuleTypeResource extends Resource
{
    protected static ?string $model = ModuleType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static UnitEnum|string|null $navigationGroup = 'System Data';

    public static function form(Schema $schema): Schema
    {
        return ModuleTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ModuleTypesTable::configure($table);
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
            'index' => ListModuleTypes::route('/'),
            'create' => CreateModuleType::route('/create'),
            'edit' => EditModuleType::route('/{record}/edit'),
        ];
    }
}
