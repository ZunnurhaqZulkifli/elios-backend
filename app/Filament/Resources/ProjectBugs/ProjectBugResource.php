<?php

namespace App\Filament\Resources\ProjectBugs;

use App\Filament\Resources\ProjectBugs\Pages\CreateProjectBug;
use App\Filament\Resources\ProjectBugs\Pages\EditProjectBug;
use App\Filament\Resources\ProjectBugs\Pages\ListProjectBugs;
use App\Filament\Resources\ProjectBugs\Schemas\ProjectBugForm;
use App\Filament\Resources\ProjectBugs\Tables\ProjectBugsTable;
use App\Models\ProjectBug;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProjectBugResource extends Resource
{
    protected static ?string $model = ProjectBug::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    protected static UnitEnum|string|null $navigationGroup = 'Projects';

    public static function form(Schema $schema): Schema
    {
        return ProjectBugForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProjectBugsTable::configure($table);
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
            'index' => ListProjectBugs::route('/'),
            'create' => CreateProjectBug::route('/create'),
            'edit' => EditProjectBug::route('/{record}/edit'),
        ];
    }
}
