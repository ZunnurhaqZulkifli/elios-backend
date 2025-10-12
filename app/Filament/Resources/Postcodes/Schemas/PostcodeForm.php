<?php

namespace App\Filament\Resources\Postcodes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PostcodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('city_id')
                    ->required()
                    ->numeric(),
                TextInput::make('state_id')
                    ->required()
                    ->numeric(),
                TextInput::make('code')
                    ->required(),
                TextInput::make('status')
                    ->required()
                    ->default('active'),
            ]);
    }
}
