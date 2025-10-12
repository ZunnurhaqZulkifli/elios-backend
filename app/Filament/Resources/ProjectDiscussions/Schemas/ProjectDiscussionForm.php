<?php

namespace App\Filament\Resources\ProjectDiscussions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProjectDiscussionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('discussable_type'),
                TextInput::make('discussable_id')
                    ->numeric(),
                TextInput::make('user_id')
                    ->numeric(),
                TextInput::make('title')
                    ->required(),
                Textarea::make('remarks')
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required()
                    ->default('active'),
            ]);
    }
}
