<?php

namespace App\Console\Commands;

use App\Actions\Modules\ModuleCalculateProgess;
use App\Models\Project;
use Illuminate\Console\Command;

class UpdateOverallProgess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cp {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recalculate and update overall progress for modules and projects';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');
        $project = Project::find($id);
        ModuleCalculateProgess::excecute($project);

        return Command::SUCCESS;
    }
}
