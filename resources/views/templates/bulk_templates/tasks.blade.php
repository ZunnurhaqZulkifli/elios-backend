<table>
  <thead>
    {{-- Instructions Section --}}
    <tr style="background-color: #ffeb3b; font-weight: bold;">
      <td colspan="{{ count($data['columns']) }}" style="text-align: center; padding: 10px;">
        BULK UPLOAD TASKS TEMPLATE - INSTRUCTIONS
      </td>
    </tr>
    <tr style="background-color: #fff9c4;">
      <td colspan="{{ count($data['columns']) }}" style="padding: 5px;">
        1. Read the REFERENCE DATA section below to understand available options
        <br>2. DO NOT delete or modify the header row (green row)
        <br>3. Fill in your data in the empty rows at the bottom of this sheet
        <br>4. All columns are required unless marked as optional
      </td>
    </tr>

    {{-- Reference Data Section --}}
    <tr style="height: 10px;"></tr>
    <tr style="background-color: #2196F3; color: white; font-weight: bold;">
      <td colspan="{{ count($data['columns']) }}" style="padding: 10px; text-align: center;">
        REFERENCE DATA - Use these IDs/values when filling your data below
      </td>
    </tr>

    @if(!empty($data['column_data']['projects']))
    <tr style="background-color: #bbdefb;">
      <td colspan="2" style="padding: 8px; font-weight: bold; border: 1px solid #ddd;">Projects (taskable_id)</td>
      <td colspan="{{ count($data['columns']) - 2 }}" style="padding: 8px; border: 1px solid #ddd;">
        @foreach($data['column_data']['projects'] as $id => $name)
        ID: {{ $id }} = {{ $name }}@if(!$loop->last) | @endif
        @endforeach
      </td>
    </tr>
    @endif

    @if(!empty($data['column_data']['assigners']))
    <tr style="background-color: #bbdefb;">
      <td colspan="2" style="padding: 8px; font-weight: bold; border: 1px solid #ddd;">Assigners (assigned_by)</td>
      <td colspan="{{ count($data['columns']) - 2 }}" style="padding: 8px; border: 1px solid #ddd;">
        @foreach($data['column_data']['assigners'] as $id => $name)
        ID: {{ $id }} = {{ $name }}@if(!$loop->last) | @endif
        @endforeach
      </td>
    </tr>
    @endif

    @if(!empty($data['column_data']['task_types']))
    <tr style="background-color: #bbdefb;">
      <td colspan="2" style="padding: 8px; font-weight: bold; border: 1px solid #ddd;">Task Types (type_id)</td>
      <td colspan="{{ count($data['columns']) - 2 }}" style="padding: 8px; border: 1px solid #ddd;">
        @foreach($data['column_data']['task_types'] as $id => $name)
        ID: {{ $id }} = {{ $name }}@if(!$loop->last) | @endif
        @endforeach
      </td>
    </tr>
    @endif

    @if(!empty($data['column_data']['levels']))
    <tr style="background-color: #bbdefb;">
      <td colspan="2" style="padding: 8px; font-weight: bold; border: 1px solid #ddd;">Levels (level_id)</td>
      <td colspan="{{ count($data['columns']) - 2 }}" style="padding: 8px; border: 1px solid #ddd;">
        @foreach($data['column_data']['levels'] as $id => $name)
        ID: {{ $id }} = {{ $name }}@if(!$loop->last) | @endif
        @endforeach
      </td>
    </tr>
    @endif

    @if(!empty($data['column_data']['status']))
    <tr style="background-color: #bbdefb;">
      <td colspan="2" style="padding: 8px; font-weight: bold; border: 1px solid #ddd;">Status (status)</td>
      <td colspan="{{ count($data['columns']) - 2 }}" style="padding: 8px; border: 1px solid #ddd;">
        @foreach($data['column_data']['status'] as $key => $value)
        {{ $key }} = {{ $value }}@if(!$loop->last) | @endif
        @endforeach
      </td>
    </tr>
    @endif

    @if(!empty($data['column_data']['phases']))
    <tr style="background-color: #bbdefb;">
      <td colspan="2" style="padding: 8px; font-weight: bold; border: 1px solid #ddd;">Project Phases (project_phase)</td>
      <td colspan="{{ count($data['columns']) - 2 }}" style="padding: 8px; border: 1px solid #ddd;">
        @foreach($data['column_data']['phases'] as $key => $value)
        {{ $key }} = {{ $value }}@if(!$loop->last) | @endif
        @endforeach
      </td>
    </tr>
    @endif

    @if(!empty($data['column_data']['modules']))
    <tr style="background-color: #bbdefb;">
      <td colspan="2" style="padding: 8px; font-weight: bold; border: 1px solid #ddd;">Project Modules (project_phase)</td>
      <td colspan="{{ count($data['columns']) - 2 }}" style="padding: 8px; border: 1px solid #ddd;">
        @foreach($data['column_data']['modules'] as $key => $value)
        {{ $key }} = {{ $value }}@if(!$loop->last) | @endif
        @endforeach
      </td>
    </tr>
    @endif

    @if(!empty($data['column_data']['branches']))
    <tr style="background-color: #bbdefb;">
      <td colspan="2" style="padding: 8px; font-weight: bold; border: 1px solid #ddd;">Project Branches (project_phase)</td>
      <td colspan="{{ count($data['columns']) - 2 }}" style="padding: 8px; border: 1px solid #ddd;">
        @foreach($data['column_data']['branches'] as $key => $value)
        {{ $key }} @if(!$loop->last) | @endif
        @endforeach
      </td>
    </tr>
    @endif

    {{-- Data Entry Section --}}
    <tr style="height: 20px;"></tr>
    <tr style="background-color: #4CAF50; color: white; font-weight: bold;">
      @foreach($data['columns'] as $column)
      <td style="padding: 10px; text-align: center; border: 1px solid #ddd;">
        {{ strtoupper(str_replace('_', ' ', $column)) }}
      </td>
      @endforeach
    </tr>

    {{-- Example Row --}}
    <tr style="background-color: #e8f5e9;">
      <td style="padding: 8px; border: 1px solid #ddd;">{{ $data['column_data']['types'] ?? 'App\Models\Project' }}</td>
      <td style="padding: 8px; border: 1px solid #ddd;">
        @if(!empty($data['column_data']['projects']))
        {{ array_key_first($data['column_data']['projects']) }}
        @else
        Project ID
        @endif
      </td>
      <td style="padding: 8px; border: 1px solid #ddd;">
        @if(!empty($data['column_data']['assigners']))
        {{ array_key_first($data['column_data']['assigners']) }}
        @else
        Assigner ID
        @endif
      </td>
      <td style="padding: 8px; border: 1px solid #ddd;">
        @if(!empty($data['column_data']['task_types']))
        {{ array_key_first($data['column_data']['task_types']) }}
        @else
        Type ID
        @endif
      </td>
      <td style="padding: 8px; border: 1px solid #ddd;">
        @if(!empty($data['column_data']['levels']))
        {{ array_key_first($data['column_data']['levels']) }}
        @else
        Level ID
        @endif
      </td>
      <td style="padding: 8px; border: 1px solid #ddd;">
        @if(!empty($data['column_data']['modules']))
        {{ array_key_first($data['column_data']['modules']) }}
        @else
        Module ID
        @endif
      </td>
      <td style="padding: 8px; border: 1px solid #ddd;">Task Title Example</td>
      <td style="padding: 8px; border: 1px solid #ddd;">Task remarks or notes here</td>
      <td style="padding: 8px; border: 1px solid #ddd;">
        @if(!empty($data['column_data']['phases']))
        {{ array_key_first($data['column_data']['phases']) }}
        @else
        Phase
        @endif
      </td>
      <td style="padding: 8px; border: 1px solid #ddd;">development</td>
      <td style="padding: 8px; border: 1px solid #ddd;">
        @if(!empty($data['column_data']['status']))
        {{ array_key_first($data['column_data']['status']) }}
        @else
        Status
        @endif
      </td>
    </tr>
  </thead>

  <tbody>
    {{-- Empty rows for data entry --}}
    @for($i = 1; $i <= 50; $i++)
      <tr>
      @foreach($data['columns'] as $column)
      <td style="padding: 8px; border: 1px solid #ddd; min-width: 120px;"></td>
      @endforeach
      </tr>
      @endfor
  </tbody>
</table>