<?php

namespace App\Filament\Resources\Modules\Pages;

use App\Filament\Resources\Modules\ModuleResource;
use App\Livewire\TaskProgressBar;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Schemas\Components\Livewire as FilamentLivewire;

class ViewModule extends ViewRecord
{
    protected static string $resource = ModuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Module Details')
                    ->description('Main module information')
                    ->icon('heroicon-o-cube')
                    ->schema([
                        FilamentLivewire::make(TaskProgressBar::class, ['record' => $this->record])
                            ->columnSpanFull(),

                        TextEntry::make('title')
                            ->label('Module Title')
                            ->size('lg')
                            ->weight(FontWeight::Bold)
                            ->icon('heroicon-o-document-text')
                            ->iconColor('primary')
                            ->columnSpanFull(),

                        TextEntry::make('type.name')
                            ->label('Module Type')
                            ->icon('heroicon-o-tag')
                            ->placeholder('Not set'),

                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->icon('heroicon-o-check-circle'),
                    ])
                    ->columns(3)
                    ->columnSpan(2),

                Section::make('Development')
                    ->icon('heroicon-o-wrench-screwdriver')
                    ->schema([
                        TextEntry::make('developer.name')
                            ->label('Developed By')
                            ->icon('heroicon-o-user')
                            ->iconColor('primary')
                            ->placeholder('Not assigned'),

                        TextEntry::make('role')
                            ->label('Module Role')
                            ->badge()
                            ->color('info')
                            ->placeholder('Not set'),

                        TextEntry::make('phase')
                            ->label('Project Phase')
                            ->badge()
                            ->color('warning')
                            ->placeholder('Not set'),
                    ])
                    ->columns(1),

                Grid::make()
                    ->columns(1)
                    ->schema([
                        Section::make('Duration & Timeline')
                            ->icon('heroicon-o-calendar')
                            ->schema([
                                TextEntry::make('estimated_duration')
                                    ->label('Estimated Duration')
                                    ->dateTime()
                                    ->icon('heroicon-o-calendar-days')
                                    ->iconColor('info')
                                    ->placeholder('Not set'),

                                TextEntry::make('total_duration')
                                    ->label('Total Duration')
                                    ->dateTime()
                                    ->icon('heroicon-o-clock')
                                    ->iconColor('warning')
                                    ->placeholder('Not set'),
                            ])
                            ->columns(1),

                        Section::make('System Information')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextEntry::make('id')
                                    ->label('Module ID')
                                    ->badge()
                                    ->color('gray'),

                                TextEntry::make('project.title')
                                    ->label('Project')
                                    ->icon('heroicon-o-folder')
                                    ->placeholder('Not linked'),

                                TextEntry::make('created_at')
                                    ->label('Created At')
                                    ->dateTime()
                                    ->icon('heroicon-o-calendar'),

                                TextEntry::make('updated_at')
                                    ->label('Last Updated')
                                    ->dateTime()
                                    ->since()
                                    ->icon('heroicon-o-clock'),
                            ])
                            ->columns(2)
                            ->collapsed(),
                    ])
                    ->columnSpan(1),
            ]);
    }
}
