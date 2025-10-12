<?php

namespace App\Filament\Resources\Postcodes;

use App\Filament\Resources\Postcodes\Pages\CreatePostcode;
use App\Filament\Resources\Postcodes\Pages\EditPostcode;
use App\Filament\Resources\Postcodes\Pages\ListPostcodes;
use App\Filament\Resources\Postcodes\Schemas\PostcodeForm;
use App\Filament\Resources\Postcodes\Tables\PostcodesTable;
use App\Models\Postcode;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PostcodeResource extends Resource
{
    protected static ?string $model = Postcode::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'code';

    protected static UnitEnum|string|null $navigationGroup = 'System Data';

    public static function form(Schema $schema): Schema
    {
        return PostcodeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PostcodesTable::configure($table);
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
            'index' => ListPostcodes::route('/'),
            'create' => CreatePostcode::route('/create'),
            'edit' => EditPostcode::route('/{record}/edit'),
        ];
    }
}
