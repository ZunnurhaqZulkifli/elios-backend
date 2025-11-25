<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\OutstandingTask;
use App\Filament\Widgets\TodayTask;
use App\Models\CurrentProject;
use App\Models\Project;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Schema;

class Dashboard extends \Filament\Pages\Dashboard implements HasForms
{
  use InteractsWithForms;

  protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-command-line';

  protected string $view = 'filament.pages.dashboard';

  protected static ?string $title = 'Z System Dashboard';

  protected static ?string $navigationLabel = 'Home';

  public $day;
  public $project_option;

  public function mount(): void
  {
    $this->day = request()->get('day', now()->day);
    $this->project_option = session('project_id');

    $this->form->fill([
      'project_option' => $this->project_option,
    ]);
  }

  public function form(Schema $form): Schema
  {
    return $form
      ->components([
        Form::make()
          ->schema([
            Select::make('project_option')
              ->label('Select Current Project')
              ->options(Project::all()->pluck('title', 'id'))
              ->live(),
          ]),
      ]);
  }

  public function updatedProjectOption($value)
  {
    session(['project_id' => $value]);

    CurrentProject::query()->delete();

    if ($value) {
      CurrentProject::create(['project_id' => $value]);
    }

    $this->dispatch('project-changed', projectId: $value);

    $this->js("
      window.location.reload();
    ");
  }

  protected function getFooterWidgets(): array
  {
    return [
      TodayTask::make(['day' => $this->day]),
      OutstandingTask::make(['day' => $this->day]),
    ];
  }
}
