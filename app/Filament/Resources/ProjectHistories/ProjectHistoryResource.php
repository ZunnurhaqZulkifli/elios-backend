<?php

namespace App\Filament\Resources\ProjectHistories;

use App\Filament\Resources\ProjectHistories\Pages\CreateProjectHistory;
use App\Filament\Resources\ProjectHistories\Pages\EditProjectHistory;
use App\Filament\Resources\ProjectHistories\Pages\ListProjectHistories;
use App\Filament\Resources\ProjectHistories\Schemas\ProjectHistoryForm;
use App\Filament\Resources\ProjectHistories\Tables\ProjectHistoriesTable;
use App\Models\ProjectHistory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProjectHistoryResource extends Resource
{
    protected static ?string $model = ProjectHistory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    protected static UnitEnum|string|null $navigationGroup = 'Projects';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return ProjectHistoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProjectHistoriesTable::configure($table);
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
            'index' => ListProjectHistories::route('/'),
            'create' => CreateProjectHistory::route('/create'),
            'edit' => EditProjectHistory::route('/{record}/edit'),
        ];
    }
}
