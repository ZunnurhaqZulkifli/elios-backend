<?php

namespace App\Filament\Resources\ProjectHistories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProjectHistoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('historable_type'),
                TextInput::make('historable_id')
                    ->numeric(),
                TextInput::make('user_id')
                    ->numeric(),
                TextInput::make('title')
                    ->required(),
                Textarea::make('remarks')
                    ->columnSpanFull(),
                TextInput::make('old_values'),
                TextInput::make('new_values'),
                TextInput::make('action')
                    ->required()
                    ->default('created'),
            ]);
    }
}
