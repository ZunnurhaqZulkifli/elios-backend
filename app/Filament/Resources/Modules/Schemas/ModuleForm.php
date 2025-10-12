<?php

namespace App\Filament\Resources\Modules\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ModuleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('project_id')
                    ->numeric(),
                TextInput::make('type_id')
                    ->numeric(),
                DateTimePicker::make('estimated_duration'),
                DateTimePicker::make('total_duration'),
                TextInput::make('progress')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('status')
                    ->required()
                    ->default('new'),
            ]);
    }
}
