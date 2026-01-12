<?php

namespace App\Filament\Resources\ProjectBranches;

use App\Filament\Resources\ProjectBranches\Pages\CreateProjectBranch;
use App\Filament\Resources\ProjectBranches\Pages\EditProjectBranch;
use App\Filament\Resources\ProjectBranches\Pages\ListProjectBranches;
use App\Filament\Resources\ProjectBranches\Schemas\ProjectBranchForm;
use App\Filament\Resources\ProjectBranches\Tables\ProjectBranchesTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\ProjectBranch;

class ProjectBranchResource extends Resource
{
    protected static ?string $model = ProjectBranch::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ProjectBranchForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProjectBranchesTable::configure($table);
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
            'index' => ListProjectBranches::route('/'),
            'create' => CreateProjectBranch::route('/create'),
            'edit' => EditProjectBranch::route('/{record}/edit'),
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
