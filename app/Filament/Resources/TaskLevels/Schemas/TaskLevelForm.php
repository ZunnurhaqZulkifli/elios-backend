<?php

namespace App\Filament\Resources\TaskLevels\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TaskLevelForm
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
