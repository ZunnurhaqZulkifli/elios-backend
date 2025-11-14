<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Models\Individual;
use App\Models\Organization;
use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                MorphToSelect::make('ownerable')
                    ->label('Tugasan Kepada')
                    ->types([
                        MorphToSelect\Type::make(Individual::class)
                            ->searchColumns(['name', 'id_number'])
                            ->label('Orang')
                            ->getOptionLabelFromRecordUsing(fn(Individual $record): string => "{$record->name} - {$record->display_name}"),

                        MorphToSelect\Type::make(Organization::class)
                            ->searchColumns(['name', 'registration_number'])
                            ->label('Syarikat')
                            ->getOptionLabelFromRecordUsing(fn(Organization $record): string => "{$record->name} - {$record->display_name}"),

                        MorphToSelect\Type::make(User::class)
                            ->searchColumns(['name', 'username'])
                            ->label('User')
                            ->getOptionLabelFromRecordUsing(fn(User $record): string => "{$record->name} - {$record->username}")
                    ])
                    ->live()
                    ->searchable()
                    ->preload()
                    ->debounce(200)
                    ->columnSpanFull(),
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
