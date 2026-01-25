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

for ($e = 1; $e <= 7; $e++) {
    $days[]=Carbon::create($current_year, $current_month, $e)->format('l');
    }

    @endphp

    <x-filament-panels::page>
        <div style="width: 100%; display: flex; gap: 20px;">
            <!-- LEFT SIDE: TABLE -->
            <div style="width: 50%;">
                <table style="border-collapse: separate; border-spacing: 0; width: 100%; border: 10px solid #374151; border-radius: 15px; overflow: hidden; background-color: #1f2937; margin-bottom: 25px;">
                    <div style="margin-bottom: 10px;">
                        Tasks {{ $now->format('F Y') }}
                    </div>
                    <tr>
                        @php
                        foreach ($days as $day) {
                        $isToday = $day === $selected_day_name;
                        $bgColor = $isToday ? 'background-color: #bf0659; color: white;' : 'background-color: #374151; color: white;';
                        $day = substr($day, 0, 3);
                        echo "
                        <td style='border: 0.01px solid #4B5563; padding: 5px !important; text-align: center; {$bgColor} font-weight: 600; width: calc(100% / 7);'>
                            {$day}
                        </td>
                        ";
                        }
                        @endphp
                    </tr>

                    @php
                    for ($q = 1; $q <= 5; $q++) {
                        echo '<tr>' ;
                        for ($d=1; $d <=7; $d++) {
                        $dayNumber=($q - 1) * 7 + $d;
                        if ($dayNumber <=$daysInMonth) {

                        $task=new \App\Models\Task();
                        $isToday=$dayNumber==$current_day;
                        $taskData=$task->getColumnData($dayNumber);
                        $bgColor = $isToday ? 'background-color: #bf0659; color: white; font-weight: 700;' : $taskData['color'];
                        $hoverStyle = !$isToday ? 'cursor: pointer;' : '';

                        echo "
                        <td style='border: 0.01px solid #4B5563; padding: 5px !important; text-align: center; {$bgColor}; {$hoverStyle}'>
                            <a id='day' class='" . ($isToday ? ' selected' : '' ) . "' style='text-decoration: none; color: inherit; display: block;'>
                                    {$dayNumber}
                                    </a>
                                </td>
                                " ;
                                } else {
                                echo "<td style='border: 0.01px solid #4B5563; padding: 5px !important; text-align: center; background-color: #111827;'></td>" ;
                                }
                                }
                                echo '</tr>' ;
                                }
                                @endphp
                                </table>
            </div>

            <!-- RIGHT SIDE: FORM + MONTH BADGE + LEGEND -->
            <div style="width: 50%;">
                <div style="margin-bottom: 20px;">
                    {{ $this->selectProject }}
                </div>

                <div style="display: flex; gap: 10px; flex-wrap: wrap; padding-bottom:10px;">
                    <div style="background-color: #c97704; color: white; font-weight: 700; padding: 5px; border-radius: 10px;">
                        {{ $now->format('d F Y') }}
                    </div>
                </div>

                <div style="display: flex; gap: 5px; flex-wrap: wrap;">
                    <div style="background-color: #66db00; color: white; font-weight: 700; padding: 3px 10px; border-radius: 10px;">
                        1-5 Tasks
                    </div>
                    <div style="background-color: #EAB308; color: white; font-weight: 700; padding: 3px 10px; border-radius: 10px;">
                        6-10 Tasks
                    </div>
                    <div style="background-color: #c97704; color: white; font-weight: 700; padding: 3px 10px; border-radius: 10px;">
                        11-20 Tasks
                    </div>
                    <div style="background-color: #bf0808; color: white; font-weight: 700; padding: 3px 10px; border-radius: 10px;">
                        21+ Tasks
                    </div>
                </div>

                <div style="margin-top: 20px;">
                    {{ $this->taskAction }}
                </div>
            </div>
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


    <!-- OLD DESIGN -->
    <!-- <div style="width: 50%;">
    <table style="border-collapse: separate; border-spacing: 0; width: 100%; border: 10px solid #374151; border-radius: 15px; overflow: hidden; background-color: #1f2937; margin-bottom: 25px;">
        <div style="margin-bottom: 10px;">
            Tasks {{ $now->format('F Y') }}
        </div>
        <tr>
            @php
            foreach ($days as $day) {
                $isToday = $day === $selected_day_name;
                $bgColor = $isToday ? 'background-color: #bf0659; color: white;' : 'background-color: #374151; color: white;';
                $day = substr($day, 0, 3);
                echo "
                <td style='border: 0.01px solid #4B5563; padding: 5px !important; text-align: center; {$bgColor} font-weight: 600; width: calc(100% / 7);'>
                    {$day}
                </td>
                ";
            }
            @endphp
        </tr>

        @php
            for ($q = 1; $q <= 5; $q++) {
                echo '<tr>';
                for ($d = 1; $d <= 7; $d++) {
                    $dayNumber = ($q - 1) * 7 + $d;
                    if ($dayNumber <= $daysInMonth) {

                        $task = new \App\Models\Task();
                        $isToday = $dayNumber == $current_day;
                        $taskData = $task->getColumnData($dayNumber);
                        $bgColor = $isToday ? 'background-color: #bf0659; color: white; font-weight: 700;' : $taskData['color'];
                        $hoverStyle = !$isToday ? 'cursor: pointer;' : '';

                        echo "
                        <td style='border: 0.01px solid #4B5563; padding: 5px !important; text-align: center; {$bgColor}; {$hoverStyle}'>
                            <a id='day' class='" . ($isToday ? 'selected' : '') . "' style='text-decoration: none; color: inherit; display: block;'>
                            {$dayNumber}
                            </a>
                        </td>
                        ";
                    } else {
                        echo "<td style='border: 0.01px solid #4B5563; padding: 5px !important; text-align: center; background-color: #111827;'></td>";
                    }
                }
                echo '</tr>';
            }
        @endphp
    </table>
</div> -->