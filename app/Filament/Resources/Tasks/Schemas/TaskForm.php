<?php

namespace App\Filament\Resources\Tasks\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TaskForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('taskable_type'),
                TextInput::make('taskable_id')
                    ->numeric(),
                TextInput::make('assigned_by')
                    ->numeric(),
                TextInput::make('type_id')
                    ->numeric(),
                TextInput::make('level_id')
                    ->numeric(),
                TextInput::make('title')
                    ->required(),
                Textarea::make('remarks')
                    ->columnSpanFull(),
                TextInput::make('file_name'),
                TextInput::make('assigner'),
                DateTimePicker::make('suggested_date'),
                DateTimePicker::make('due_date'),
                Toggle::make('is_completed')
                    ->required(),
                DateTimePicker::make('completed_at'),
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
