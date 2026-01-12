<?php

namespace App\Filament\Resources\ProjectDiscussions\Schemas;

use App\Models\CurrentProject;
use App\Models\Project;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProjectDiscussionForm
{
    public static function configure(Schema $schema): Schema
    {
        $currentProjectId = CurrentProject::id();
        $currentProject = Project::find($currentProjectId);

        return $schema
            ->components([
                Select::make('project_id')
                    ->label('Project')
                    // ->relationship('project', 'title')
                    ->required(),

                Select::make('status')
                    ->required()
                    ->options([
                        'open'        => 'Open',
                        'in_progress' => 'In Progress',
                        'closed'      => 'Closed',
                    ]),

                TextInput::make('title')
                    ->required()
                    ->columnSpanFull(),

                Textarea::make('remarks')
                    ->columnSpanFull(),

                FileUpload::make('attachment')
                    ->label('Attachment')
                    ->disk('public')
                    ->directory('project_discussions')
                    ->multiple()
                    ->columnSpanFull(),

                Select::make('pic')
                    ->label('Person In Charge')
                    ->options(function() use ($currentProject) {
                        return $currentProject ? $currentProject->ownerable->members->pluck('individual.name', 'individual.id')->toArray() : [];
                    })
                    ->multiple()
                    ->required(),
            ]);
    }
}
