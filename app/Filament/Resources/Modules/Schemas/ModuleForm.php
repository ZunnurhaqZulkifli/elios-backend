<?php

namespace App\Filament\Resources\Modules\Schemas;

use App\Enums\ModuleRole;
use App\Enums\ModuleStatus;
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

                Select::make('type')
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
                            
                            return [];
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
                    ->options(
                        ModuleStatus::options()
                    )
                    ->required(),

                Select::make('role')
                    ->options(
                        ModuleRole::options()
                    )
                    ->required(),
            ]);
    }
}
