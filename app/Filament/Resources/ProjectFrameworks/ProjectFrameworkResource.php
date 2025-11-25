<?php

namespace App\Filament\Resources\ProjectFrameworks;

use App\Filament\Resources\ProjectFrameworks\Pages\CreateProjectFramework;
use App\Filament\Resources\ProjectFrameworks\Pages\EditProjectFramework;
use App\Filament\Resources\ProjectFrameworks\Pages\ListProjectFrameworks;
use App\Filament\Resources\ProjectFrameworks\Schemas\ProjectFrameworkForm;
use App\Filament\Resources\ProjectFrameworks\Tables\ProjectFrameworksTable;
use App\Models\ProjectFramework;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class ProjectFrameworkResource extends Resource
{
    protected static ?string $model = ProjectFramework::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static UnitEnum|string|null $navigationGroup = 'Projects';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return ProjectFrameworkForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProjectFrameworksTable::configure($table);
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
            'index' => ListProjectFrameworks::route('/'),
            'create' => CreateProjectFramework::route('/create'),
            'edit' => EditProjectFramework::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
