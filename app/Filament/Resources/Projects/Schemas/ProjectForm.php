<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Enums\ProjectPhase;
use App\Enums\ProjectStatus;
use App\Models\Individual;
use App\Models\Organization;
use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Log;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->columnSpanFull()
                    ->required(),

                MorphToSelect::make('ownerable')
                    ->label('Project Owner')
                    ->types([
                        MorphToSelect\Type::make(Individual::class)
                            ->searchColumns(['name', 'id_number'])
                            ->label('Orang')
                            ->getOptionLabelFromRecordUsing(fn(Individual $record): string => "{$record->name} - {$record->display_name}"),

                        MorphToSelect\Type::make(Organization::class)
                            ->searchColumns(['name', 'registration_number'])
                            ->label('Syarikat')
                            ->getOptionLabelFromRecordUsing(fn(Organization $record): string => "{$record->name} - {$record->display_name}"),

                        // MorphToSelect\Type::make(User::class)
                        //     ->searchColumns(['name', 'username'])
                        //     ->label('User')
                        //     ->getOptionLabelFromRecordUsing(fn(User $record): string => "{$record->name} - {$record->username}")
                    ])
                    ->live()
                    ->searchable()
                    ->preload()
                    ->debounce(200)
                    ->columnSpanFull(),

                Select::make('pic')
                    ->label('Person In Charge')
                    ->options(function (callable $get) {
                        $ownerable_type = $get('ownerable_type');
                        $ownerable_id = $get('ownerable_id');

                        // Return empty array if no ownerable is selected
                        if (!$ownerable_type || !$ownerable_id) {
                            return [];
                        }

                        if($ownerable_type === Organization::class) {
                            $organization = Organization::find($ownerable_id);
                            
                            if ($organization) {
                                $members = $organization->members;
                                return $members->pluck('individual.name', 'individual.id')->toArray();
                            }
                        }
                        
                        return [];
                    }),

                Select::make('type')
                    ->relationship('type', 'name')
                    ->required(),

                Select::make('category')
                    ->relationship('category', 'name')
                    ->required(),

                DateTimePicker::make('start_at'),

                DateTimePicker::make('end_at'),

                DateTimePicker::make('projected_end_at'),

                Select::make('status')
                    ->options(ProjectStatus::options())
                    ->required(),

                Select::make('phase')
                    ->options(ProjectPhase::options())
                    ->required(),
                
                TextInput::make('git_url')
                    ->label('Git Repository')
                    ->url(),

                TextInput::make('live_url')
                    ->label('Live URL'),

                TextInput::make('staging_url')
                    ->label('Staging URL'),

                Textarea::make('description')
                    ->columnSpanFull(),

                
            ]);
    }
}
