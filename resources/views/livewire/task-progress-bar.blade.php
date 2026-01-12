<div class="w-100">
    @php
    $progress = $this->getProgressValue();
    @endphp

    <div class="progress-bar-label-2">
        Tasks Progress : {{ $progress }}%
    </div>

    <div class="progress-bar-2 w-100">
        <div class="progress-bar-value-2" style="width:{{ $progress }}%">

        </div>
    </div>
</div>