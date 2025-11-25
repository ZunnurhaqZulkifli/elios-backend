<?php

namespace App\Filament\Resources\ModuleTaskTemplates;

use App\Filament\Resources\ModuleTaskTemplates\Pages\CreateModuleTaskTemplate;
use App\Filament\Resources\ModuleTaskTemplates\Pages\EditModuleTaskTemplate;
use App\Filament\Resources\ModuleTaskTemplates\Pages\ListModuleTaskTemplates;
use App\Filament\Resources\ModuleTaskTemplates\Schemas\ModuleTaskTemplateForm;
use App\Filament\Resources\ModuleTaskTemplates\Tables\ModuleTaskTemplatesTable;
use App\Models\ModuleTaskTemplate;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ModuleTaskTemplateResource extends Resource
{
    protected static ?string $model = ModuleTaskTemplate::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    protected static UnitEnum|string|null $navigationGroup = 'Management';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Task Templates';

    public static function form(Schema $schema): Schema
    {
        return ModuleTaskTemplateForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ModuleTaskTemplatesTable::configure($table);
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
            'index' => ListModuleTaskTemplates::route('/'),
            'create' => CreateModuleTaskTemplate::route('/create'),
            'edit' => EditModuleTaskTemplate::route('/{record}/edit'),
        ];
    }
}
