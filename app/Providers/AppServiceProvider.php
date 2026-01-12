<?php

namespace App\Providers;

use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);

        Table::configureUsing(function (Table $table): void {
            $table
                ->filtersLayout(FiltersLayout::Dropdown)
                // ->filtersFormWidth(MaxWidth::Full)
                ->recordActionsAlignment('right')
                ->defaultSort('created_at', 'asc')
                ->paginatedWhileReordering(true)
                // ->reorderable(true)
                ->paginationPageOptions([10, 50, 100, 'all'])
                ->emptyStateDescription('No records found')
                ->columnManagerMaxHeight('500px');
        });
    }
}
