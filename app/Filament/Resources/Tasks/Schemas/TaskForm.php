<?php

namespace App\Filament\Resources\Tasks\Schemas;

use App\Actions\Tasks\TaskSuggestDate;
use App\Enums\ProjectPhaseEnum;
use App\Enums\TaskStatusEnum;
use App\Filament\Resources\ProjectBranches\ProjectBranchResource;
use App\Models\Individual;
use App\Models\Module;
use App\Models\Organization;
use App\Models\Project;
use App\Models\TaskLevel;
use App\Models\TaskType;
use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
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
                            ->getOptionLabelFromRecordUsing(fn(Individual $record): string => "{$record->display_name} - {$record->name}"),

                        MorphToSelect\Type::make(Organization::class)
                            ->searchColumns(['name', 'registration_number'])
                            ->label('Syarikat')
                            ->getOptionLabelFromRecordUsing(fn(Organization $record): string => "{$record->display_name} - {$record->name}"),

                        MorphToSelect\Type::make(User::class)
                            ->searchColumns(['name', 'username'])
                            ->label('User')
                            ->getOptionLabelFromRecordUsing(fn(User $record): string => "{$record->username} - {$record->name}"),

                        MorphToSelect\Type::make(Module::class)
                            ->searchColumns(['title', 'project.title'])
                            ->label('Module')
                            ->getOptionLabelFromRecordUsing(fn(Module $record): string => "{$record->project->title} - {$record->title}"),

                        MorphToSelect\Type::make(Project::class)
                            ->searchColumns(['title', 'ownerable.name'])
                            ->label('Project')
                            ->getOptionLabelFromRecordUsing(fn(Project $record): string => "{$record->ownerable->name} - {$record->title}"),
                    ])
                    ->preload()
                    ->live()
                    ->searchable()
                    ->debounce(200)
                    ->columnSpanFull(),

                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->columnSpanFull(),

                Textarea::make('remarks')
                    ->columnSpanFull(),

                FileUpload::make('attachments')
                    ->openable()
                    ->label('Attachments')
                    ->multiple()
                    ->disk('public')
                    ->directory('task/attachments')
                    ->deletable(true)
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

                        if($taskable_type === Project::class) {
                            $project = Project::find($taskable_id);
                            
                            if ($project) {
                                $members = $project->ownerable->members;
                                return $members->pluck('individual.name', 'individual.id')->toArray();
                            }
                        }
                        
                        return Individual::all()->pluck('name', 'id')->toArray();
                    })
                    ->label('Person In Charge')
                    ->required(),

                Select::make('type_id')
                    ->label('Type')
                    ->options(TaskType::all()->pluck('name', 'id'))
                    ->required(),

                Select::make('module_id')
                    ->label('Project Module')
                    ->options(function (Get $get) {
                        $taskable_type = $get('taskable_type');
                        $taskable_id = $get('taskable_id');

                        if($taskable_type === Project::class) {
                            $project = Project::find($taskable_id);
                            
                            if ($project) {
                                $modules = $project->modules;
                                return $modules->pluck('title', 'id')->toArray();
                            }
                        }

                        return Module::all()->pluck('title', 'id')->toArray();
                    })
                    ->required(),

                Select::make('level_id')
                    ->label('Level')
                    ->options(TaskLevel::all()->pluck('name', 'id'))
                    ->live()
                    ->afterStateUpdated(function (Set $set, Get $get) {
                        $level = $get('level_id');
                        $suggested_date = TaskSuggestDate::handle($level);
                        $set('suggested_date', $suggested_date);
                    })
                    ->debounce(200)
                    ->required(),

                TextInput::make('file_name')
                    ->label('Files Changed'),

                DateTimePicker::make('suggested_date')
                    ->label('Suggested Date')
                    ->visible(fn(Get $get) => $get('level_id') !== null),

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

                Select::make('phase')
                    ->label('Project Phase')
                    ->options(ProjectPhaseEnum::options()),

                Select::make('branch_id')
                    ->label('Project Branch')
                    ->options(function (Get $get) {
                        $taskable_type = $get('taskable_type');
                        $taskable_id = $get('taskable_id');

                        if($taskable_type === Project::class) {
                            $project = Project::find($taskable_id);
                            
                            if ($project) {
                                $branches = $project->branches;
                                return $branches->pluck('name', 'id')->toArray();
                            }
                        }

                        return [];
                    })
                    ->createOptionForm(fn(Schema $schema) => ProjectBranchResource::form($schema))
                    ->createOptionUsing(function (array $data, Get $get) {
                        $taskable_type = $get('taskable_type');
                        $taskable_id = $get('taskable_id');

                        if($taskable_type === Project::class) {
                            $project = Project::find($taskable_id);
                            
                            if ($project) {
                                $branch = $project->branches()->create([
                                    'name' => $data['name'],
                                ]);
                                return $branch->name;
                            }
                        }

                        return null;
                    })
            ])
            ->columns(2);
    }
}
