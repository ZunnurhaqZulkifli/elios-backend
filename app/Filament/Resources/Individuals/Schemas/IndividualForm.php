<?php

namespace App\Filament\Resources\Individuals\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class IndividualForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('display_name'),
                TextInput::make('title')
                    ->required(),
                TextInput::make('position')
                    ->required()
                    ->default('employee'),
                Textarea::make('about')
                    ->columnSpanFull(),
                TextInput::make('location'),
                TextInput::make('phone')
                    ->tel(),
                TextInput::make('address_1'),
                TextInput::make('address_2'),
                TextInput::make('country_id')
                    ->numeric(),
                TextInput::make('state_id')
                    ->numeric(),
                TextInput::make('city_id')
                    ->numeric(),
                TextInput::make('postcode'),
                TextInput::make('priority')
                    ->required()
                    ->default('low'),
                TextInput::make('status')
                    ->required()
                    ->default('unverified'),
            ]);
    }
}
