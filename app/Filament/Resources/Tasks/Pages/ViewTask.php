<?php

namespace App\Filament\Resources\Tasks\Pages;

use App\Filament\Resources\Tasks\TaskResource;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;

class ViewTask extends ViewRecord
{
    protected static string $resource = TaskResource::class;

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Task Details')
                    ->description('Main task information')
                    ->icon('heroicon-o-clipboard-document-check')
                    ->schema([
                        TextEntry::make('title')
                            ->label('Task Title')
                            ->size('lg')
                            ->weight(FontWeight::Bold)
                            ->icon('heroicon-o-document-text')
                            ->iconColor('primary')
                            ->columnSpanFull(),

                        TextEntry::make('remarks')
                            ->label('Remarks')
                            ->markdown()
                            ->columnSpanFull()
                            ->placeholder('No remarks'),

                        TextEntry::make('status')
                            ->badge()
                            ->size('lg'),

                        TextEntry::make('is_completed')
                            ->label('Completed')
                            ->badge()
                            ->formatStateUsing(fn($state) => $state ? 'Yes' : 'No')
                            ->color(fn($state) => $state ? 'success' : 'gray'),

                        TextEntry::make('progress')
                            ->label('Progress')
                            ->suffix('%')
                            ->badge()
                            ->color(fn($state) => match (true) {
                                $state >= 100 => 'success',
                                $state >= 75 => 'info',
                                $state >= 50 => 'warning',
                                default => 'danger',
                            }),
                    ])
                    ->columns(3)
                    ->columnSpan(2),

                Section::make('Assignment')
                    ->icon('heroicon-o-user-group')
                    ->schema([
                        TextEntry::make('assignedBy.name')
                            ->label('Assigned By')
                            ->icon('heroicon-o-user')
                            ->iconColor('primary')
                            ->placeholder('Not set'),

                        TextEntry::make('personInCharge.name')
                            ->label('Person in Charge')
                            ->icon('heroicon-o-user-circle')
                            ->iconColor('success')
                            ->placeholder('Not assigned'),

                        TextEntry::make('task')
                            ->label('Task Type')
                            ->badge()
                            ->color('info')
                            ->placeholder('Not set'),

                        TextEntry::make('level')
                            ->label('Priority Level')
                            ->badge()
                            ->color('warning')
                            ->placeholder('Not set'),
                    ])
                    ->columns(1),

                Grid::make()
                    ->columns(1)
                    ->schema([
                        Section::make('Schedule')
                            ->icon('heroicon-o-calendar')
                            ->schema([
                                TextEntry::make('suggested_date')
                                    ->label('Suggested Date')
                                    ->dateTime()
                                    ->icon('heroicon-o-calendar-days')
                                    ->iconColor('info')
                                    ->placeholder('Not set'),

                                TextEntry::make('due_date')
                                    ->label('Due Date')
                                    ->dateTime()
                                    ->icon('heroicon-o-clock')
                                    ->iconColor('warning')
                                    ->color(
                                        fn($state, $record) =>
                                        $state && $state < now() && !$record->is_completed
                                            ? 'danger'
                                            : 'primary'
                                    )
                                    ->placeholder('No deadline'),

                                TextEntry::make('completed_at')
                                    ->label('Completed At')
                                    ->dateTime()
                                    ->icon('heroicon-o-check-circle')
                                    ->iconColor('success')
                                    ->placeholder('Not completed'),
                            ])
                            ->columns(1),

                        Section::make('System Information')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextEntry::make('id')
                                    ->label('Task ID')
                                    ->badge()
                                    ->color('gray'),

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

                Section::make('Related Information')
                    ->icon('heroicon-o-link')
                    ->schema([
                        TextEntry::make('taskable_type')
                            ->label('Related To')
                            ->formatStateUsing(fn($state) => $state ? class_basename($state) : 'N/A'),

                        TextEntry::make('taskable.title')
                            ->label('Related Item')
                            ->icon('heroicon-o-folder')
                            ->placeholder('Not linked'),

                        TextEntry::make('file_name')
                            ->label('Attached File')
                            ->icon('heroicon-o-paper-clip')
                            ->placeholder('No file'),
                    ])
                    ->columns(1)
                    ->columnSpan(2),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
