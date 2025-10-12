<?php

namespace App\Filament\Resources\ProjectBugs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProjectBugForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('buggable_type'),
                TextInput::make('buggable_id')
                    ->numeric(),
                TextInput::make('test_id')
                    ->numeric(),
                TextInput::make('discovered_by')
                    ->numeric(),
                TextInput::make('severity_id')
                    ->numeric(),
                TextInput::make('title')
                    ->required(),
                FileUpload::make('image')
                    ->image(),
                DateTimePicker::make('discovered_at'),
                TextInput::make('status')
                    ->required()
                    ->default('draft'),
            ]);
    }
}
