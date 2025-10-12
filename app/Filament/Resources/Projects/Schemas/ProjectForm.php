<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('ownerable_type'),
                TextInput::make('ownerable_id')
                    ->numeric(),
                TextInput::make('pic')
                    ->numeric(),
                TextInput::make('type_id')
                    ->numeric(),
                TextInput::make('category_id')
                    ->numeric(),
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                DateTimePicker::make('start_at'),
                DateTimePicker::make('end_at'),
                DateTimePicker::make('projected_end_at'),
                TextInput::make('status')
                    ->required()
                    ->default('new'),
            ]);
    }
}
