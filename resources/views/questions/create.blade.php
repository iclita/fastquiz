@extends('layout')

@section('title')
    FastQuiz - My Questions
@stop

@section('content')

<div class="container profile-container">
    <div class="row card-container">
        <div class="col-md-8 col-md-offset-2 first-item-panel">
            <div class="panel panel-default">
              <div class="panel-heading clearfix">
                <h3 class="panel-title pull-left">Add New Question</h3>
                <div class="btn-group pull-right">
                  <a class="btn btn-danger" href="{{ route('questions') }}">
                    <i class="fa fa-times"></i>
                    Cancel
                  </a>
                  <button class="btn btn-success item-save">
                    <i class="fa fa-check"></i>
                    Save
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
                    {!! Form::select('category', categories(), old('category'), ['class'=>'form-control', 'required', 'placeholder' => 'Choose a category']) !!}
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      @if ($errors->has('description'))
                      <p class="input-error">{{ $errors->first('description') }}</p>
                      @endif
                      <textarea name="description" class="form-control" rows="5" required maxlength="150" placeholder="Question (max. 150 characters)">{{ old('description') }}</textarea>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                      @if ($errors->has('choice_a'))
                      <p class="input-error">{{ $errors->first('choice_a') }}</p>
                      @endif
                      <div class="input-group question-choice">
                        <span class="input-group-addon">
                          {!! Form::radio('correct', 'a', old('correct') === 'a', ['aria-label' => 'choice_a']) !!}
                        </span>
                        <input type="text" name="choice_a" class="form-control" required maxlength="50" placeholder="First choice (max. 50 characters)" value="{{ old('choice_a') }}" aria-label="choice_a"/>
                      </div>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                      @if ($errors->has('choice_b'))
                      <p class="input-error">{{ $errors->first('choice_b') }}</p>
                      @endif
                      <div class="input-group question-choice">
                        <span class="input-group-addon">
                          {!! Form::radio('correct', 'b', old('correct') === 'b', ['aria-label' => 'choice_b']) !!}
                        </span>
                        <input type="text" name="choice_b" class="form-control" required maxlength="50" placeholder="Second choice (max. 50 characters)" value="{{ old('choice_b') }}" aria-label="choice_b"/>
                      </div>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                      @if ($errors->has('choice_c'))
                      <p class="input-error">{{ $errors->first('choice_c') }}</p>
                      @endif
                      <div class="input-group question-choice">
                        <span class="input-group-addon">
                          {!! Form::radio('correct', 'c', old('correct') === 'c', ['aria-label' => 'choice_c']) !!}
                        </span>
                        <input type="text" name="choice_c" class="form-control" required maxlength="50" placeholder="Third choice (max. 50 characters)" value="{{ old('choice_c') }}" aria-label="choice_c"/>
                      </div>
                    </div>
                  </div>

                  <div class="row">                    
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                      @if ($errors->has('choice_d'))
                      <p class="input-error">{{ $errors->first('choice_d') }}</p>
                      @endif
                      <div class="input-group question-choice">
                        <span class="input-group-addon">
                          {!! Form::radio('correct', 'd', old('correct') === 'd', ['aria-label' => 'choice_d']) !!}
                        </span>
                        <input type="text" name="choice_d" class="form-control" required maxlength="50" placeholder="Fourth choice (max. 50 characters)" value="{{ old('choice_d') }}" aria-label="choice_d"/>
                      </div>
                    </div>
                  </div>

                  @if ($errors->has('correct'))
                    <p class="input-error">You need to select one correct choice</p>
                  @endif

                </form>
              </div>
              <div class="panel-footer">
                <small>FastQuiz - Test your knowledge speed</small>
              </div>
            </div>
        </div>
    </div>
</div>

@stop
