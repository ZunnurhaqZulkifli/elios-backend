<?php

namespace App\Actions\Modules;

use App\Actions\Tasks\TaskCalculateProgess;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class ModuleCalculateProgess
{
    public static function excecute(Project $project)
    {
        $total = DB::transaction(function () use ($project) {
            foreach ($project->modules as $module) {
                $module->update([
                    'progress' => TaskCalculateProgess::excecute($module),
                ]);
            }
        });

        return round($total, 2);
    }
}
