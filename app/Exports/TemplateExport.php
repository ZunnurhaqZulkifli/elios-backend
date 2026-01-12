<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TemplateExport implements FromView, ShouldAutoSize
{
    use Exportable;

    protected $data;
    protected $type;

    public function __construct($data)
    {
        $this->data = $data;
        $this->type = $data['type'];
    }

    public function view() : View
    {
        return view('templates.bulk_templates.' . $this->type, [
            'data' => $this->data,
        ]);
    }
}
