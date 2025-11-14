<?php

namespace App\Filament\Resources\ProjectDiscussions;

use App\Filament\Resources\ProjectDiscussions\Pages\CreateProjectDiscussion;
use App\Filament\Resources\ProjectDiscussions\Pages\EditProjectDiscussion;
use App\Filament\Resources\ProjectDiscussions\Pages\ListProjectDiscussions;
use App\Filament\Resources\ProjectDiscussions\Schemas\ProjectDiscussionForm;
use App\Filament\Resources\ProjectDiscussions\Tables\ProjectDiscussionsTable;
use App\Models\ProjectDiscussion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProjectDiscussionResource extends Resource
{
    protected static ?string $model = ProjectDiscussion::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $recordTitleAttribute = 'title';

    protected static UnitEnum|string|null $navigationGroup = 'Tasks';

    protected static ?int $navigationSort = 4;

    public static function getModelLabel(): string
    {
        return 'Discussion';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Discussions';
    }   

    public static function form(Schema $schema): Schema
    {
        return ProjectDiscussionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProjectDiscussionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProjectDiscussions::route('/'),
            'create' => CreateProjectDiscussion::route('/create'),
            'edit' => EditProjectDiscussion::route('/{record}/edit'),
        ];
    }
}
