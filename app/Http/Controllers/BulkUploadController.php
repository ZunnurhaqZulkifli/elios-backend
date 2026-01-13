<?php

namespace App\Http\Controllers;

use App\Enums\ModuleRoleEnum;
use App\Enums\ModuleStatusEnum;
use App\Enums\ProjectPhaseEnum;
use App\Enums\TaskStatusEnum;
use App\Exports\TemplateExport;
use App\Models\CurrentProject;
use App\Models\Module;
use App\Models\ModuleType;
use App\Models\Project;
use App\Models\ProjectBranch;
use App\Models\Task;
use App\Models\TaskLevel;
use App\Models\TaskType;
use App\Models\User;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class BulkUploadController extends Controller
{
    public function load(string $type)
    {
        $data = [];
        $current_project_id = CurrentProject::id();
        $current_project = Project::find($current_project_id);

        switch ($type) {
            case 'modules':

                // lists of projects
                $data['column_data']['projects'] = Project::all()
                    ->pluck('title', 'id')
                    ->toArray();

                // module types
                $data['column_data']['types'] = ModuleType::all()
                    ->pluck('name', 'id')
                    ->toArray();

                // developers
                $data['column_data']['developers'] = User::first()
                    ->pluck('name', 'id')
                    ->toArray();

                // module roles
                $data['column_data']['roles'] = ModuleRoleEnum::options();

                // project phases
                $data['column_data']['phases'] = ProjectPhaseEnum::options();

                // module statuses
                $data['column_data']['statuses'] = ModuleStatusEnum::options();

                $data['columns'] = [
                    'title',
                    'project_id',
                    'type_id',
                    'estimated_duration',
                    'developed_by',
                    'role',
                    'phase',
                    'progress',
                    'status',
                ];
                break;

            case 'tasks':

                // typeable type
                $data['column_data']['types'] = 'App\Models\Project';

                // lists of projects
                $data['column_data']['projects'] = $current_project
                    ->pluck('title', 'id')
                    ->toArray();

                // lists of assigners
                $data['column_data']['assigners'] =
                    $current_project->ownerable->members
                    ->pluck('individual.display_name', 'individual.id')
                    ->toArray();

                // types
                $data['column_data']['task_types'] =
                    TaskType::all()->pluck('name', 'id')
                    ->toArray();

                // levels
                $data['column_data']['levels'] =
                    TaskLevel::all()->pluck('name', 'id')
                    ->toArray();

                // task status
                $data['column_data']['status'] =
                    TaskStatusEnum::options();

                // project phases
                $data['column_data']['phases'] =
                    ProjectPhaseEnum::options();

                // project modules
                $data['column_data']['modules'] = 
                    Module::where('project_id', $current_project_id)
                    ->where('phase', $current_project->phase)
                    ->pluck('title', 'id')
                    ->toArray();

                // project branches
                $data['column_data']['branches'] =
                    $current_project->branches
                    ->pluck('name', 'name')
                    ->toArray();

                // template columns
                $data['columns'] = [
                    'taskable_type',
                    'taskable_id',
                    'assigned_by',
                    'type_id',
                    'level_id',
                    'module_id',
                    'title',
                    'remarks',
                    'phase',
                    'branch',
                    'status',
                ];
                break;

            default:
                $data = [];
                break;
        }

        return $data;
    }

    public function download(string $type = 'tasks')
    {
        $data = $this->load($type);
        $data['type'] = $type;

        $fileName = 'bulk_' . $type . '_upload_template.xlsx';

        return Excel::download(
            new TemplateExport($data),
            $fileName,

        );
    }

    public function upload(array $data, string $type)
    {
        DB::transaction(function () use ($data, $type, &$totalRows) {
            // Get the uploaded file path from
            $filePath = $data['bulk_upload_file'];

            // Use Storage facade to get the correct full path
            $fullPath = Storage::disk('public')
                ->path($filePath);

            // Read the Excel file line by line
            $excelData = Excel::toArray([], $fullPath);

            // Get the first sheet
            $sheets = $excelData[0] ?? [];

            // Total rows created
            $totalRows = 0;

            if (empty($sheets)) {
                return 0;
            }

            foreach ($sheets as $key => $row) {
                if ($row === null || empty($row)) {
                    continue;
                } else {
                    if ($type === 'tasks' && $key >= 15) {

                        if($row[5] === null) {
                            continue;
                        }

                        $task = new Task();
                        
                        $branch = ProjectBranch::where('project_id', $row[1] != null ? intval($row[1]) : null)
                            ->where('name', $row[9] ?? null)
                            ->first();

                        if(!$branch) {
                            $branch = ProjectBranch::create([
                                'project_id' => $row[1] != null ? intval($row[1]) : null,
                                'name' => $row[9] ?? null,
                            ]);
                        }

                        $task->fill([
                            'taskable_type' => $row[0] ?? null,
                            'taskable_id'   => $row[1] != null ? intval($row[1]) : null,
                            'pic'           => $row[2] != null ? intval($row[2]) : null,
                            'type_id'       => $row[3] != null ? intval($row[3]) : null,
                            'level_id'      => $row[4] != null ? intval($row[4]) : null,
                            'module_id'     => $row[5] != null ? intval($row[5]) : null,
                            'title'         => $row[6] != null ? strtoupper($row[6]) : null,
                            'remarks'       => $row[7] != null ? strtolower($row[7]) : null,
                            'phase'         => $row[8] ?? null,
                            'branch_id'     => $branch ? $branch->id : null,
                            'status'        => $row[10] ?? null,
                            'is_completed'  => false,
                            'progress'      => 0,
                        ]);



                        $task->save();

                        $totalRows++;
                    }

                    if ($type === 'modules' && $key >= 13) {
                        
                        if($row[0] === null) {
                            continue;
                        }

                        $module = new Module();

                        $module->fill([
                            'title'              => $row[0] ?? null,
                            'project_id'         => $row[1] != null ? intval($row[1]) : null,
                            'type_id'            => $row[2] != null ? intval($row[2]) : null,
                            'estimated_duration' => $row[3] != null ? Carbon::create($row[3]) : null,
                            'developed_by'       => $row[4] != null ? intval($row[4]) : null,
                            'role'               => $row[5] ?? null,
                            'phase'              => $row[6] ?? null,
                            'progress'           => $row[7] != null ? floatval($row[7]) : 0.0,
                            'status'             => $row[8] ?? null,
                        ]);

                        $module->save();

                        $totalRows++;
                    }
                }
            }

            return $totalRows;
        });

        return $totalRows;
    }

    public function view(string $type = 'tasks')
    {
        $data = $this->load($type);
        $data['type'] = $type;

        $orientation = match ($type) {
            'tasks' => 'landscape',
            default => 'landscape',
        };

        $size = match ($type) {
            'tasks' => 'a4',
            default => 'a4',
        };

        $pdf = SnappyPdf::loadView('printings.bulk_uploads.tasks', [
            'data' => $data,
        ])
            ->setPaper($size)
            ->setOption('enable-local-file-access', true)
            ->setOrientation($orientation)
            ->setOptions([
                'margin-top' => 15,
                'margin-left' => 5,
                'margin-right' => 5,
                'margin-bottom' => 15,
            ]);

        return $pdf->inline('Upload Bulk Tasks' . '-' . now()->format('d-m-Y') . '.pdf');
    }
}
