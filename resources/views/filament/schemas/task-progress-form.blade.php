<div {{ $getExtraAttributeBag() }}>
  @php
  $progress = $getProgressValue();
  @endphp

  <div class="progress-bar-label">
    {{ $progress }}%
  </div>

  <div class="progress-bar">
    <div class="progress-bar-value" style="width:{{ $progress }}%">

    </div>
  </div>
</div>