<?php

namespace App\Filament\Resources\ProjectGroups\Pages;

use App\Filament\Resources\ProjectGroups\ProjectGroupResource;
use App\Models\ProjectGroup;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section as ComponentsSection;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class ViewProjectGroup extends ViewRecord implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = ProjectGroupResource::class;

    protected string $view = 'filament.resources.project-groups.pages.view-project-group';

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                ComponentsSection::make('Project Group Details')
                    ->schema([
                        TextEntry::make('id')
                            ->label('ID')
                            ->badge()
                            ->color('gray'),

                        TextEntry::make('group.name')
                            ->label('Group')
                            ->icon('heroicon-o-user-group')
                            ->iconColor('primary'),

                        TextEntry::make('project.title')
                            ->label('Project')
                            ->icon('heroicon-o-briefcase')
                            ->iconColor('success')
                            ->url(fn($record) => $record->project ? route('filament.admin.resources.projects.view', $record->project) : null)
                            ->openUrlInNewTab(),

                        TextEntry::make('task_count')
                            ->label('Total Tasks')
                            ->badge()
                            ->color('success')
                            ->icon('heroicon-o-check-circle'),
                    ])
                    ->columns(2),

                ComponentsSection::make('Timestamps')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Created At')
                            ->dateTime()
                            ->icon('heroicon-o-calendar'),

                        TextEntry::make('updated_at')
                            ->label('Updated At')
                            ->dateTime()
                            ->icon('heroicon-o-calendar')
                            ->since(),
                    ])
                    ->columns(1)
                    ->collapsible(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ProjectGroup::query()
                    ->where('group_id', $this->record->group_id)
                    ->with(['project', 'group'])
            )
            ->heading('Projects')
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('project.title')
                    ->label('Project')
                    ->searchable()
                    ->sortable()
                    ->url(fn($record) => $record->project ? route('filament.admin.resources.projects.view', $record->project) : null)
                    ->openUrlInNewTab(),

                TextColumn::make('project.status')
                    ->label('Status')
                    ->badge(),

                TextColumn::make('task_count')
                    ->label('Tasks')
                    ->badge()
                    ->color('success'),

                TextColumn::make('created_at')
                    ->label('Added')
                    ->dateTime()
                    ->sortable()
                    ->since(),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped();
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
