<?php

namespace App\Filament\Resources\Tasks\Schemas;

use App\Enums\TaskStatusEnum;
use App\Models\Individual;
use App\Models\Module;
use App\Models\Organization;
use App\Models\Project;
use App\Models\TaskLevel;
use App\Models\TaskType;
use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class TaskForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                MorphToSelect::make('taskable')
                    ->label('Tugasan')
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
                            ->getOptionLabelFromRecordUsing(fn(User $record): string => "{$record->name} - {$record->username}"),

                        MorphToSelect\Type::make(Module::class)
                            ->searchColumns(['title', 'project.title'])
                            ->label('Module')
                            ->getOptionLabelFromRecordUsing(fn(Module $record): string => "{$record->title} - {$record->project->title}"),

                        MorphToSelect\Type::make(Project::class)
                            ->searchColumns(['title', 'ownerable.name'])
                            ->label('Project')
                            ->getOptionLabelFromRecordUsing(fn(Project $record): string => "{$record->title} - {$record->ownerable->name}"),
                    ])
                    ->live()
                    ->searchable()
                    ->preload()
                    ->debounce(200)
                    ->columnSpanFull(),

                Select::make('pic')
                    ->options(function(Get $get) {
                        $taskable_type = $get('taskable_type');
                        $taskable_id = $get('taskable_id');

                        if($taskable_type === Module::class) {
                            $module = Module::find($taskable_id);
                            
                            if ($module) {
                                $members = $module->project->ownerable->members;
                                return $members->pluck('individual.name', 'individual.id')->toArray();
                            }
                        }
                        
                        return Individual::all()->pluck('name', 'id')->toArray();
                    })
                    ->label('Person In Charge')
                    ->createOptionForm(
                        [
                            TextInput::make('name')
                                ->required()
                                ->unique(table: User::class, column: 'name')
                                ->label('Name'),
                        ]
                    )
                    ->required(),

                Select::make('type_id')
                    ->label('Type')
                    ->options(TaskType::all()->pluck('name', 'id'))
                    ->required(),

                Select::make('level_id')
                    ->label('Level')
                    ->options(TaskLevel::all()->pluck('name', 'id'))
                    ->required(),

                TextInput::make('title')
                    ->label('Title')
                    ->required(),

                Textarea::make('remarks')
                    ->columnSpanFull(),

                TextInput::make('file_name')
                    ->label('Files Changed'),

                DateTimePicker::make('suggested_date'),

                DateTimePicker::make('due_date')
                    ->required(),

                Toggle::make('is_completed')
                    ->hiddenOn(['create'])
                    ->required(),

                DateTimePicker::make('completed_at'),

                TextInput::make('progress')
                    ->prefix('%')
                    ->required()
                    ->numeric()
                    ->default(0.0)
                    ->hiddenOn(['edit', 'create']),

                Select::make('status')
                    ->required()
                    ->options(TaskStatusEnum::options()),
            ]);
    }
}
