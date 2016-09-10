@extends('layout')

@section('title')
    FastQuiz - @lang('home.menu.my_questions')
@stop

@section('content')

<div class="container profile-container">
    <div class="row card-container">
        <div class="col-md-8 col-md-offset-2 first-item-panel">
            <div class="panel panel-default material-box">
              <div class="panel-heading clearfix">
                <h3 class="panel-title pull-left">@lang('question.add_question')</h3>
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
                <form class="form-horizontal item-form" method="POST" action="{{ route('store-question') }}">

                  {{ csrf_field() }}

                  <div class="form-group">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                      @if ($errors->has('category'))
                      <p class="input-error">{{ $errors->first('category') }}</p>
                      @endif
                    {!! Form::select('category', categories(), old('category'), ['class'=>'form-control material-box', 'required', 'placeholder' => trans('question.choose_category')]) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      @if ($errors->has('description'))
                      <p class="input-error">{{ $errors->first('description') }}</p>
                      @endif
                      <textarea name="description" class="form-control material-box" rows="5" required maxlength="200" placeholder="@lang('question.choose_description')">{{ old('description') }}</textarea>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                      @if ($errors->has('choice_a'))
                      <p class="input-error">{{ $errors->first('choice_a') }}</p>
                      @endif
                      <div class="input-group question-choice">
                        <span class="input-group-addon material-box">
                          {!! Form::radio('correct', 'a', old('correct') === 'a', ['aria-label' => 'choice_a']) !!}
                        </span>
                        <input type="text" name="choice_a" class="form-control material-box" required maxlength="75" placeholder="@lang('question.first_choice')" value="{{ old('choice_a') }}" aria-label="choice_a"/>
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
                          {!! Form::radio('correct', 'b', old('correct') === 'b', ['aria-label' => 'choice_b']) !!}
                        </span>
                        <input type="text" name="choice_b" class="form-control material-box" required maxlength="75" placeholder="@lang('question.second_choice')" value="{{ old('choice_b') }}" aria-label="choice_b"/>
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
                          {!! Form::radio('correct', 'c', old('correct') === 'c', ['aria-label' => 'choice_c']) !!}
                        </span>
                        <input type="text" name="choice_c" class="form-control material-box" required maxlength="75" placeholder="@lang('question.third_choice')" value="{{ old('choice_c') }}" aria-label="choice_c"/>
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
                          {!! Form::radio('correct', 'd', old('correct') === 'd', ['aria-label' => 'choice_d']) !!}
                        </span>
                        <input type="text" name="choice_d" class="form-control material-box" required maxlength="75" placeholder="@lang('question.fourth_choice')" value="{{ old('choice_d') }}" aria-label="choice_d"/>
                      </div>
                    </div>
                  </div>

                  @if ($errors->has('correct'))
                    <p class="input-error">@lang('question.no_choice')</p>
                  @endif

                </form>
              </div>
              <div class="panel-footer">
                <small>FastQuiz - @lang('home.motto')</small>
              </div>
            </div>
        </div>
    </div>
</div>

@stop
