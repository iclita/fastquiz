@extends('layout')

@section('title')
    FastQuiz - @lang('question.edit_question')
@stop

@section('content')

<div class="container profile-container">
    <div class="row card-container">
        <div class="col-md-8 col-md-offset-2 first-item-panel">
            <div class="panel panel-default material-box">
              <div class="panel-heading clearfix">
                <h3 class="panel-title pull-left">@lang('question.edit_question')</h3>
                <div class="btn-group pull-right">
                  <a class="btn btn-danger material-box" href="{{ route('questions') }}">
                    <i class="fa fa-times"></i>
                    @lang('question.cancel')
                  </a>
                  <button class="btn btn-success item-save material-box">
                    <i class="fa fa-check"></i>
                    @lang('question.save')
                  </button>
                </div>
              </div>
              <div class="modal-body">
                {!! Form::model($question, ['method'=>'POST', 'route'=>['update-question', 'id'=>$question->id], 'class'=>'form-horizontal item-form']) !!}

                  <div class="form-group">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                      @if ($errors->has('category'))
                      <p class="input-error">{{ $errors->first('category') }}</p>
                      @endif
                    {!! Form::select('category', categories(), $question->category->id, ['class'=>'form-control material-box', 'required', 'placeholder' => trans('question.choose_category')]) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      @if ($errors->has('description'))
                      <p class="input-error">{{ $errors->first('description') }}</p>
                      @endif
                      {!! Form::textarea('description', null, ['class'=>'form-control material-box', 'rows'=>'5', 'required', 'maxlength'=>'200', 'placeholder'=>trans('question.choose_description')]) !!}
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                      @if ($errors->has('choice_a'))
                      <p class="input-error">{{ $errors->first('choice_a') }}</p>
                      @endif
                      <div class="input-group question-choice">
                        <span class="input-group-addon material-box">
                          {!! Form::radio('correct', 'a', ['aria-label' => 'choice_a']) !!}
                        </span>
                        {!! Form::text('choice_a', null, ['class'=>'form-control material-box', 'required', 'maxlength'=>'75', 'placeholder'=>trans('question.first_choice'), 'aria-label' => 'choice_a']) !!}
                      </div>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                      @if ($errors->has('choice_b'))
                      <p class="input-error">{{ $errors->first('choice_b') }}</p>
                      @endif
                      <div class="input-group question-choice">
                        <span class="input-group-addon material-box">
                          {!! Form::radio('correct', 'b', ['aria-label' => 'choice_b']) !!}
                        </span>
                        {!! Form::text('choice_b', null, ['class'=>'form-control material-box', 'required', 'maxlength'=>'75', 'placeholder'=>trans('question.second_choice'), 'aria-label' => 'choice_b']) !!}
                      </div>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                      @if ($errors->has('choice_c'))
                      <p class="input-error">{{ $errors->first('choice_c') }}</p>
                      @endif
                      <div class="input-group question-choice">
                        <span class="input-group-addon material-box">
                          {!! Form::radio('correct', 'c', ['aria-label' => 'choice_c']) !!}
                        </span>
                        {!! Form::text('choice_c', null, ['class'=>'form-control material-box', 'required', 'maxlength'=>'75', 'placeholder'=>trans('question.third_choice'), 'aria-label' => 'choice_c']) !!}
                      </div>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                      @if ($errors->has('choice_d'))
                      <p class="input-error">{{ $errors->first('choice_d') }}</p>
                      @endif
                      <div class="input-group question-choice">
                        <span class="input-group-addon material-box">
                          {!! Form::radio('correct', 'd', ['aria-label' => 'choice_d']) !!}
                        </span>
                        {!! Form::text('choice_d', null, ['class'=>'form-control material-box', 'required', 'maxlength'=>'75', 'placeholder'=>trans('question.fourth_choice'), 'aria-label' => 'choice_d']) !!}
                      </div>
                    </div>
                  </div>

                {!! Form::close() !!}
              </div>
              <div class="panel-footer">
                <small>FastQuiz - Test your knowledge speed</small>
              </div>
            </div>
        </div>
    </div>
</div>

@stop
