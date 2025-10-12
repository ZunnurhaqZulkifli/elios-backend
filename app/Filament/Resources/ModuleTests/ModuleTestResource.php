<?php

namespace App\Filament\Resources\ModuleTests;

use App\Filament\Resources\ModuleTests\Pages\CreateModuleTest;
use App\Filament\Resources\ModuleTests\Pages\EditModuleTest;
use App\Filament\Resources\ModuleTests\Pages\ListModuleTests;
use App\Filament\Resources\ModuleTests\Schemas\ModuleTestForm;
use App\Filament\Resources\ModuleTests\Tables\ModuleTestsTable;
use App\Models\ModuleTest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ModuleTestResource extends Resource
{
    protected static ?string $model = ModuleTest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    protected static UnitEnum|string|null $navigationGroup = 'System Data';

    public static function form(Schema $schema): Schema
    {
        return ModuleTestForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ModuleTestsTable::configure($table);
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
            'index' => ListModuleTests::route('/'),
            'create' => CreateModuleTest::route('/create'),
            'edit' => EditModuleTest::route('/{record}/edit'),
        ];
    }
}
