<?php

namespace App\Filament\Resources\Countries\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CountryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('display_name')
                    ->required(),
                TextInput::make('code')
                    ->required(),
                TextInput::make('currency'),
                TextInput::make('phone_code')
                    ->tel(),
                TextInput::make('status')
                    ->required()
                    ->default('active'),
            ]);
    }
}
