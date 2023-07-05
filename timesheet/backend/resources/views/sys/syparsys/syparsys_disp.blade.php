<?php if ($syparsys->input_type == 'textarea'): ?>
<textarea id="d_parvalue" class="form-control input-sm" rows="15">{{ $val }}</textarea>
<?php elseif ($syparsys->input_type == 'number'): ?>
<input type="number" id="d_parvalue" value="{{ $val }}" class="form-control input-sm">
<?php elseif ($syparsys->input_type == 'date'): ?>
<input type="date" id="d_parvalue" value="{{ $val }}" class="form-control input-sm">
<?php else: ?>
<input type="text" id="d_parvalue" value="{{ $val }}" class="form-control input-sm">
<?php endif; ?>
<br>
<button class="btn btn-sm btn-primary btn-block" type="button"
    onclick="mainCtrl().saveDash('{{ $syparsys->parid }}');">Save</button>
<br>
<div class="text-warning text-right">Source : {{ $syparsys->parid }}</div>
