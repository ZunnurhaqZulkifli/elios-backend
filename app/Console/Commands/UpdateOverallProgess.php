<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;

class UpdateOverallProgess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cp';

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
        $project = Project::find(1);

        $this->calculateModuleProgress($project);

        return Command::SUCCESS;
    }

    public function calculateModuleProgress(Project $project)
    {
        foreach($project->modules as $module) {
            $module->update([
                'progess' => '',
            ]);
        }
        return 0;
    }
}
