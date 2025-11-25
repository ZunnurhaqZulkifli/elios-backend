@php
use Carbon\Carbon;

$now = Carbon::now();

$daysInMonth = $now->daysInMonth;
$currentDay = $now->format('l');

$current_year = $now->year;
$current_month = $now->month;
$current_day = request()->get('day', $now->day);
$selected_day_name = Carbon::create($current_year, $current_month, $current_day)->format('l');

$days = [];

for($e = 1; $e <= 7; $e++) {
  $days[] = Carbon::create($current_year, $current_month, $e)->format('l');
}

@endphp

<x-filament-panels::page>
  <div class="mb-4">
    <form wire:submit.prevent="submit">
      {{ $this->form }}
    </form>
  </div>

  <div>
    <div>
      <h2>{{ $now->format('F Y') }}</h2>
    </div>

    <div class="">
      Legends
    </div>

    <table class="" style="border-collapse: separate; border-spacing: 0; width: 100%; border: 0.01px solid #374151; border-radius: 15px; overflow: hidden; background-color: #1f2937;">
      <tr>
        @php
          foreach ($days as $day) {
            $isToday = ($day === $selected_day_name);
            $bgColor = $isToday ? 'background-color: #bf0659; color: white;' : 'background-color: #374151; color: white;';
            $day = substr($day, 0, 3);
            echo "<td style='border: 0.01px solid #4B5563; padding: 10px; text-align: center; {$bgColor} font-weight: 600; width: calc(100% / 7);'>
              {$day}
            </td>";
          }
        @endphp
      </tr>
      @php
          for($q= 1; $q <= 5; $q++) {
            echo "<tr>";
            for ($d = 1; $d <= 7; $d++) {
              $dayNumber = (($q - 1) * 7) + $d;
              if ($dayNumber <= $daysInMonth) {
                
                /*
                  * Active days
                */

                $task = new \App\Models\Task();
                $isToday = ($dayNumber == $current_day);
                $taskData = $task->getColumnData($dayNumber);
                $bgColor = $isToday ? 'background-color: #bf0659; color: white; font-weight: 700;' : $taskData['color'];
                $hoverStyle = !$isToday ? 'cursor: pointer;' : '';

                echo "
                  <td style='border: 0.01px solid #4B5563; padding: 10px; text-align: center; {$bgColor} {$hoverStyle}'>
                    <!-- onmouseover=\"if(!this.querySelector('a').classList.contains('selected')) this.style.backgroundColor='#374151'\" 
                    onmouseout=\"if(!this.querySelector('a').classList.contains('selected')) this.style.backgroundColor='#18181B'\"> -->
                    <a id='day' class='" . ($isToday ? "selected" : "") . "' style='text-decoration: none; color: inherit; display: block;'>
                      {$dayNumber}
                    </a>
                  </td>  
                ";
              } else {
                
                /*
                  * Empty cell
                */

                echo "<td style='border: 0.01px solid #4B5563; padding: 10px; text-align: center; background-color: #111827;'></td>";
              }
            }
            echo "</tr>";
          }
      @endphp
    </table>
  </div>
</x-filament-panels::page>

<script>
  document.querySelectorAll('#day').forEach(item => {
    item.addEventListener('click', event => {
      const selectedDay = event.target.innerText;
      const url = new URL(window.location.href);
      url.searchParams.set('day', selectedDay);
      window.location.href = url.toString();
    });
  });
</script>