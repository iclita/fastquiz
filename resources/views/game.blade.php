@extends('layout')

@section('title')
    FastQuiz - @lang('home.game')
@stop

@section('content')

<div class="container profile-container">
  <div class="row card-container">
    <div class="col-md-8 col-md-offset-2">
      <div class="progress material-box">
        <div class="progress-bar counter-bar progress-bar-striped material-box" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
        </div>
      </div>
    </div>
    <div class="col-md-8 col-md-offset-2 first-item-panel">
        <div class="panel panel-default material-box">
          <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left">{{ $question->getCategoryName() }}</h3>
            <div id="answer-checker" class="pull-right">
              <i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>
            </div>
          </div>
          <div class="modal-body">
            <span id="alias">{{ $alias }}</span>
            <p class="play-description">{{ $question->description }}</p>
            @foreach ($question->getChoices() as $index => $choice)
            <div style="text-align:center;" class="row">
              <button class="btn btn-primary material-box play-choice" data-choice="{{ $index }}">{{ $choice }}</button>
            </div>
            @endforeach
          </div>
          <div class="panel-footer">
            <small>FastQuiz - @lang('home.motto')</small>
          </div>
        </div>
    </div>

    <div style="text-align:center;" class="col-md-6 col-md-offset-3">
      <a style="font-size: 20px; width:50%;" href="{{ route('play') }}" class="btn btn-info material-box">@lang('home.next')</a>
    </div>

  </div>
</div>

@push('scripts')
    <script src="{{ cached_asset('js/gameplay.js') }}"></script>
@endpush

@stop
