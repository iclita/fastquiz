@if ($model->isApproved())
<div class="status status-approved" data-toggle="tooltip" data-placement="top" title="@lang('home.status.approved', ['item' => $model->getResourceName()])">
  <i class="fa fa-check" aria-hidden="true"></i>
</div>
@elseif ($model->isRejected())
<div class="status status-rejected" data-toggle="tooltip" data-placement="top" title="@lang('home.status.rejected', ['item' => $model->getResourceName()])">
  <i class="fa fa-times" aria-hidden="true"></i>
</div>
@else
<div class="status status-pending" data-toggle="tooltip" data-placement="top" title="@lang('home.status.pending', ['item' => $model->getResourceName()])">
  <i class="fa fa-clock-o" aria-hidden="true"></i>
</div>
@endif