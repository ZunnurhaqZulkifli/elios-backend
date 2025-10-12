<?php

namespace App\Filament\Resources\ModuleTests\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ModuleTestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('testable_type'),
                TextInput::make('testable_id')
                    ->numeric(),
                TextInput::make('tester_id')
                    ->numeric(),
                TextInput::make('type_id')
                    ->numeric(),
                TextInput::make('title')
                    ->required(),
                Textarea::make('remarks')
                    ->columnSpanFull(),
                Toggle::make('tested')
                    ->required(),
                DateTimePicker::make('tested_at'),
                TextInput::make('status')
                    ->required()
                    ->default('testing'),
            ]);
    }
}
