<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use App\Filament\Resources\Projects\RelationManagers\ModulesRelationManager;
use App\Filament\Resources\Projects\RelationManagers\TasksRelationManager;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Grid as ComponentsGrid;
use Filament\Schemas\Components\Section as ComponentsSection;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;

class ViewProject extends ViewRecord
{
    protected static string $resource = ProjectResource::class;

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                ComponentsSection::make('Project Overview')
                    ->headerActions([
                        Action::make('phase')
                            ->badge()
                            ->disabled()
                            ->label(function ($record) {
                                return $record->phase?->getLabel() ?? '-';
                            })
                            ->color(function ($record) {
                                return $record->phase?->getColor() ?? 'secondary';
                            }),
                    ])
                    ->description('Key information about this project')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        TextEntry::make('title')
                            ->label('Project Title')
                            ->size('lg')
                            ->weight(FontWeight::Bold)
                            ->icon('heroicon-o-briefcase')
                            ->iconColor('primary'),

                        TextEntry::make('description')
                            ->label('Description')
                            ->markdown()
                            ->columnSpanFull(),

                        TextEntry::make('status')
                            ->badge()
                            ->size('lg'),

                        TextEntry::make('type.name')
                            ->label('Project Type')
                            ->badge()
                            ->color('info'),

                        TextEntry::make('category.name')
                            ->label('Category')
                            ->badge()
                            ->color('warning'),

                        TextEntry::make('framework.name')
                            ->label('Framework')
                            ->badge()
                            ->color('success')
                            ->icon('heroicon-o-code-bracket'),
                    ])
                    ->columns(3),

                ComponentsGrid::make()
                    ->columns(1)
                    ->schema([
                        ComponentsSection::make('People & Ownership')
                            ->icon('heroicon-o-user-group')
                            ->schema([
                                TextEntry::make('ownerable.name')
                                    ->label('Owner ID'),

                                TextEntry::make('ownerable_type')
                                    ->label('Owner Type')
                                    ->formatStateUsing(fn($state) => class_basename($state)),

                                TextEntry::make('personInCharge.name')
                                    ->label('Person in Charge')
                                    ->icon('heroicon-o-user')
                                    ->iconColor('primary'),
                            ])
                            ->columns(3),

                        ComponentsSection::make('Timeline & Schedule')
                            ->icon('heroicon-o-calendar')
                            ->schema([
                                TextEntry::make('start_at')
                                    ->label('Start Date')
                                    ->date()
                                    ->icon('heroicon-o-play')
                                    ->iconColor('success'),

                                TextEntry::make('projected_end_at')
                                    ->label('Projected End')
                                    ->dateTime()
                                    ->icon('heroicon-o-clock')
                                    ->iconColor('warning'),

                                TextEntry::make('end_at')
                                    ->label('Actual End Date')
                                    ->date()
                                    ->icon('heroicon-o-flag')
                                    ->iconColor('danger')
                                    ->placeholder('Ongoing'),
                            ])
                            ->columns(3),

                        ComponentsSection::make('Links & Resources')
                            ->icon('heroicon-o-link')
                            ->schema([
                                TextEntry::make('git_url')
                                    ->label('Git Repository')
                                    ->url(fn($state) => $state)
                                    ->openUrlInNewTab()
                                    ->icon('heroicon-o-code-bracket-square')
                                    ->copyable()
                                    ->placeholder('Not set'),

                                TextEntry::make('staging_url')
                                    ->label('Staging URL')
                                    ->url(fn($state) => $state)
                                    ->openUrlInNewTab()
                                    ->icon('heroicon-o-beaker')
                                    ->copyable()
                                    ->placeholder('Not set'),

                                TextEntry::make('live_url')
                                    ->label('Live URL')
                                    ->url(fn($state) => $state)
                                    ->openUrlInNewTab()
                                    ->icon('heroicon-o-globe-alt')
                                    ->copyable()
                                    ->placeholder('Not set'),
                            ])
                            ->collapsed(true)
                            ->columns(3)
                            ->collapsible(),
                    ]),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return false;
    }
}
