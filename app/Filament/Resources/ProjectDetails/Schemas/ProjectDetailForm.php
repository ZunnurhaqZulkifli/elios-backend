<?php

namespace App\Filament\Resources\ProjectDetails\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProjectDetailForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('project_id')
                    ->numeric(),
                Textarea::make('details')
                    ->columnSpanFull(),
                TextInput::make('budget')
                    ->required()
                    ->numeric()
                    ->default(0.0),
            ]);
    }
}
