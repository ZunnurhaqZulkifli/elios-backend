<?php

namespace App\Filament\Resources\ProjectDetails;

use App\Filament\Resources\ProjectDetails\Pages\CreateProjectDetail;
use App\Filament\Resources\ProjectDetails\Pages\EditProjectDetail;
use App\Filament\Resources\ProjectDetails\Pages\ListProjectDetails;
use App\Filament\Resources\ProjectDetails\Schemas\ProjectDetailForm;
use App\Filament\Resources\ProjectDetails\Tables\ProjectDetailsTable;
use App\Models\ProjectDetail;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProjectDetailResource extends Resource
{
    protected static ?string $model = ProjectDetail::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'details';

    protected static UnitEnum|string|null $navigationGroup = 'Projects';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return ProjectDetailForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProjectDetailsTable::configure($table);
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
            'index' => ListProjectDetails::route('/'),
            'create' => CreateProjectDetail::route('/create'),
            'edit' => EditProjectDetail::route('/{record}/edit'),
        ];
    }
}
