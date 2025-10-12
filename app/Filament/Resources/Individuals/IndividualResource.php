<?php

namespace App\Filament\Resources\Individuals;

use App\Filament\Resources\Individuals\Pages\CreateIndividual;
use App\Filament\Resources\Individuals\Pages\EditIndividual;
use App\Filament\Resources\Individuals\Pages\ListIndividuals;
use App\Filament\Resources\Individuals\Schemas\IndividualForm;
use App\Filament\Resources\Individuals\Tables\IndividualsTable;
use App\Models\Individual;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class IndividualResource extends Resource
{
    protected static ?string $model = Individual::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static UnitEnum|string|null $navigationGroup = 'System Data';

    public static function form(Schema $schema): Schema
    {
        return IndividualForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return IndividualsTable::configure($table);
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
            'index' => ListIndividuals::route('/'),
            'create' => CreateIndividual::route('/create'),
            'edit' => EditIndividual::route('/{record}/edit'),
        ];
    }
}
