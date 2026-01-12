<?php

namespace App\Filament\Resources\ProjectBranches\Schemas;

use App\Models\Project;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProjectBranchForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('project_id')
                    ->options(function () {
                        return Project::all()->pluck('title', 'id')->toArray();
                    })
                    ->required(),

                TextInput::make('name')
                    ->required(),
            ]);
    }
}
