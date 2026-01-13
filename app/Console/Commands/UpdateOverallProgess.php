<?php

namespace App\Console\Commands;

use App\Actions\Modules\ModuleCalculateProgess;
use App\Enums\ModuleStatusEnum;
use App\Enums\TaskProgressEnum;
use App\Enums\TaskStatusEnum;
use App\Models\Module;
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
        ModuleCalculateProgess::excecute($project);

        return Command::SUCCESS;
    }
}
