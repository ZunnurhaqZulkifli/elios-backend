<?php

namespace App\Filament\Resources\Projects\RelationManagers;

use App\Filament\Resources\Modules\ModuleResource;
use App\Models\Module;
use Dom\Text;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;

class ModulesRelationManager extends RelationManager
{
    protected static string $relationship = 'modules';

    protected static ?string $relatedResource = ModuleResource::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(function() {
                $query = Module::query()
                    ->where('project_id', '=', $this->ownerRecord->id);

                return $query;
            })
            ->columns([
                TextColumn::make('index')
                    ->label('No. ')
                    ->rowIndex(),

                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('title')
                    ->label('Title'),

                TextColumn::make('type.name')
                    ->badge()
                    ->label('Type'),

                TextColumn::make('progress')
                    ->label('Progress (%)'),

                TextColumn::make('status')
                    ->badge()
                    ->label('Status'),

                TextColumn::make('estimated_duration')
                    ->dateTime()
                    ->label('Estimated Duration'),

                TextColumn::make('total_duration')
                    ->dateTime()
                    ->label('Total Duration'),
            ])
            ->headerActions([
                Action::make('create')
                    ->label('Add Module')
                    ->schema(fn(Schema $schema) => ModuleResource::form($schema))
                    ->action(function (array $data) {
                        unset($data['project']);

                        $data['project_id'] = $this->ownerRecord->id ?? null;
                        $data['type_id'] = $data['type'] ?? null;

                        return $this->getRelatedResource()::mutateFormDataBeforeCreate($data);
                    }),
            ]);
    }
}
