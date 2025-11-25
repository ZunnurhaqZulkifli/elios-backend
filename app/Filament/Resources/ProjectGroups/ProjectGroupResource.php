<?php

namespace App\Filament\Resources\ProjectGroups;

use App\Filament\Resources\ProjectGroups\Pages\CreateProjectGroup;
use App\Filament\Resources\ProjectGroups\Pages\EditProjectGroup;
use App\Filament\Resources\ProjectGroups\Pages\ListProjectGroups;
use App\Filament\Resources\ProjectGroups\Pages\ViewProjectGroup;
use App\Filament\Resources\ProjectGroups\Schemas\ProjectGroupForm;
use App\Filament\Resources\ProjectGroups\Tables\ProjectGroupsTable;
use App\Models\ProjectGroup;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProjectGroupResource extends Resource
{
    protected static ?string $model = ProjectGroup::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static UnitEnum|string|null $navigationGroup = 'Tasks';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return ProjectGroupForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProjectGroupsTable::configure($table);
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
            'index' => ListProjectGroups::route('/'),
            'create' => CreateProjectGroup::route('/create'),
            'view' => ViewProjectGroup::route('/{record}'),
            'edit' => EditProjectGroup::route('/{record}/edit'),
        ];
    }
}
