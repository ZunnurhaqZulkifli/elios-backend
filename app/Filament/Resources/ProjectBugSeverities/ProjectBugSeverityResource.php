<?php

namespace App\Filament\Resources\ProjectBugSeverities;

use App\Filament\Resources\ProjectBugSeverities\Pages\CreateProjectBugSeverity;
use App\Filament\Resources\ProjectBugSeverities\Pages\EditProjectBugSeverity;
use App\Filament\Resources\ProjectBugSeverities\Pages\ListProjectBugSeverities;
use App\Filament\Resources\ProjectBugSeverities\Schemas\ProjectBugSeverityForm;
use App\Filament\Resources\ProjectBugSeverities\Tables\ProjectBugSeveritiesTable;
use App\Models\ProjectBugSeverity;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProjectBugSeverityResource extends Resource
{
    protected static ?string $model = ProjectBugSeverity::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static UnitEnum|string|null $navigationGroup = 'Projects';

    public static function form(Schema $schema): Schema
    {
        return ProjectBugSeverityForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProjectBugSeveritiesTable::configure($table);
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
            'index' => ListProjectBugSeverities::route('/'),
            'create' => CreateProjectBugSeverity::route('/create'),
            'edit' => EditProjectBugSeverity::route('/{record}/edit'),
        ];
    }
}
