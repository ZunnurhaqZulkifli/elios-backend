<?php

namespace App\Filament\Resources\Modules\Schemas;

use App\Enums\ModuleRoleEnum;
use App\Enums\ModuleStatusEnum;
use App\Enums\ProjectPhaseEnum;
use App\Models\CurrentProject;
use App\Models\ModuleType;
use App\Models\Project;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Operation;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\AssignOp\Mod;

class ModuleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),

                Select::make('project')
                    ->searchable()
                    ->preload()
                    ->relationship('project', 'title')
                    ->hiddenOn(Operation::Create)
                    ->required(),

                Select::make('type_id')
                    ->label('Module Type')
                    ->options(
                        function ($livewire) {
                            // Check if we're in a RelationManager context
                            if ($livewire instanceof \Filament\Resources\RelationManagers\RelationManager) {
                                $project = $livewire->getOwnerRecord();
                                
                                $moduleTypes = ModuleType::where('framework_id', $project->framework_id)
                                    ->pluck('name', 'id')
                                    ->toArray();

                                return $moduleTypes;
                            }

                            $current_project = CurrentProject::id();
                            
                            if($current_project) {
                                return ModuleType::where('framework_id', Project::find($current_project)->framework_id)
                                    ->pluck('name', 'id')
                                    ->toArray();
                            }

                            return ModuleType::pluck('name', 'id')->toArray();
                        }
                    )
                    ->required(),

                DateTimePicker::make('estimated_duration')
                    ->label('End Date')
                    ->required(),

                DateTimePicker::make('total_duration')
                    ->hiddenOn(Operation::Create),

                TextInput::make('progress')
                    ->required()
                    ->numeric()
                    ->hiddenOn(Operation::Create)
                    ->default(0.0),

                Select::make('status')
                    ->options(ModuleStatusEnum::options())
                    ->required(),

                Select::make('role')
                    ->label('Your Role')
                    ->options(ModuleRoleEnum::options())
                    ->required(),

                Select::make('phase')
                    ->options(ProjectPhaseEnum::options())
                    ->required(),
            ]);
    }
}
