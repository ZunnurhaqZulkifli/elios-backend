<?php

namespace App\Filament\Resources\ProjectTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProjectTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('weight')
                    ->required()
                    ->numeric()
                    ->default(1.0),
                TextInput::make('status')
                    ->required()
                    ->default('active'),
            ]);
    }
}
