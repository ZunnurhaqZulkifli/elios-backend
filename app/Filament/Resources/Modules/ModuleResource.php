<?php

namespace App\Filament\Resources\Modules;

use App\Enums\TaskStatusEnum;
use App\Filament\Resources\Modules\Pages\CreateModule;
use App\Filament\Resources\Modules\Pages\EditModule;
use App\Filament\Resources\Modules\Pages\ListModules;
use App\Filament\Resources\Modules\Pages\ViewModule;
use App\Filament\Resources\Modules\Schemas\ModuleForm;
use App\Filament\Resources\Modules\Tables\ModulesTable;
use App\Filament\Resources\Tasks\RelationManagers\TasksRelationManager;
use App\Models\CurrentProject;
use App\Models\Module;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ModuleResource extends Resource
{
    protected static ?string $model = Module::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    protected static UnitEnum|string|null $navigationGroup = 'Projects';

    public static function getModelLabel(): string
    {
        return 'Module';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Modules';
    }

    public static function getNavigationBadge(): ?string
    {
        $currentProejct = CurrentProject::id();

        return (string) static::$model::whereHas('project', function ($query) use ($currentProejct) {
            if(!$currentProejct) {
                return 0;
            }

            $query->where('id', $currentProejct);
        })
        ->count();
    }

    public static function form(Schema $schema): Schema
    {
        return ModuleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ModulesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            TasksRelationManager::class
        ];
    }

    public static function mutateFormDataBeforeCreate(array $data)
    {
        return self::create($data);
    }

    public static function create(array $data)
    {
        $model = new Module();
        $model->fill($data);
        $model->save();

        foreach($model->taskTemplates as $template) {
            $model->tasks()->create([
                'title'        => $template->title,
                'assigned_by'  => null,
                'due_date'     => $data['estimated_duration'],
                'status'       => TaskStatusEnum::NEW,
                'progress'     => 0,
                'type_id'      => 3,                             // New
                'level_id'     => 2,                             // Medium
                'is_completed' => false,
            ]);
        }
        
        return $model;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListModules::route('/'),
            'create' => CreateModule::route('/create'),
            'view' => ViewModule::route('/{record}'),
            'edit' => EditModule::route('/{record}/edit'),
        ];
    }
}
