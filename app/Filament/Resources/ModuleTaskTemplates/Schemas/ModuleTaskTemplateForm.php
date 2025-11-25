<?php

namespace App\Filament\Resources\ModuleTaskTemplates\Schemas;

use Dom\Text;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ModuleTaskTemplateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('moduleType')
                    ->label('Task Type')
                    ->relationship('moduleType', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->columnSpanFull(),

                TextInput::make('title')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }
}
