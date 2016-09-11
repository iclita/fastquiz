@extends('layout')

@section('title')
    FastQuiz - @lang('home.menu.my_questions')
@stop

@section('content')

<div class="container profile-container">
    <h2><a href="{{ route('questions') }}">@lang('home.menu.my_questions')</a></h2>
    @if ($questions->count() > 0)
    <a class="btn btn-primary btn-block add-item material-box" href="{{ route('create-question') }}">
      <i class="fa fa-plus"></i>
      Add
    </a>
    @endif
    <div class="row">
        @if ($questions->count() > 0)
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 bootcards-list">

          <div class="panel panel-default material-box">

            <div class="panel-body">
              <form method="GET" action="{{ route('questions') }}">
                <input type="hidden" name="search" value="true" />
                <div class="row">
                  <div style="padding-right:10px;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">  
                    <div class="form-group">
                      <input type="text" class="form-control material-box" name="keywords" value="{{ Request::input('keywords', '') }}" placeholder="@lang('question.looking_for')">
                      <i class="fa fa-search"></i>
                    </div>
                  </div>
                </div>
                <div style="margin-top:15px;" class="row">
                  <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                    <div class="form-group">
                      {!! Form::select('category', categories(), Request::input('category', ''), ['class'=>'form-control material-box', 'placeholder' => 'All categories']) !!}
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                    <div class="form-group">
                      {!! Form::select('status', trans('question.status'), Request::input('status', ''), ['class'=>'form-control material-box', 'placeholder' => trans('question.all_questions')]) !!}
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                    <button type="submit" class="btn btn-primary material-box">@lang('question.search')</button>
                  </div>
                </div>
              </form>
            </div>

            <div class="list-group">
              @foreach ($questions as $index=>$question)
                  {{-- Make the first item active --}}
                  @if ($index === 0)
                  <a class="list-group-item active show-question"
                    data-id="{{ $question->id }}" 
                    data-description="{{ $question->description }}" 
                    data-category="{{ $question->getCategoryName() }}" 
                    data-answer="{{ $question->getAnswer() }}" 
                    href="javascript:void(0);">
                  @else
                  <a class="list-group-item show-question" 
                    data-id="{{ $question->id }}" 
                    data-description="{{ $question->description }}" 
                    data-category="{{ $question->getCategoryName() }}" 
                    data-answer="{{ $question->getAnswer() }}" 
                    href="javascript:void(0);">
                  @endif
                    <img src="{{ $question->getCategoryIcon() }}" class="img-rounded pull-left"/>
                    <h4 class="list-group-item-heading">{{ short($question->description) }}</h4>
                    <p class="list-group-item-text">@lang('question.category'): {{ $question->getCategoryName() }}</p>
                    @include('partials.status', ['model' => $question])
                  </a>
              @endforeach
            </div>

          </div>

          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pagination-container">
              {!! $questions->appends($query)->links() !!}
            </div>
          </div>

        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 bootcards-cards">

        <div class="panel panel-default material-box">
          <div class="panel-heading clearfix">
              <a class="btn btn-danger pull-left delete-question material-box" href="javascript:void(0);" data-id="{{ $questions->first()->id }}">
                <i class="fa fa-times"></i>
                @lang('question.delete')
              </a>
              <a class="btn btn-primary pull-right edit-question material-box" href="{{ route('edit-question', ['id'=>$questions->first()->id]) }}">
                <i class="fa fa-pencil"></i>
                @lang('question.edit')
              </a>
            </div>
            <div class="list-group">
              <div class="list-group-item">
                <p class="list-group-item-text">@lang('question.category')</p>
                <h4 class="list-group-item-heading show-question-category">{{ $questions->first()->getCategoryName() }}</h4>
              </div>
              <div class="list-group-item">
                <p class="list-group-item-text">@lang('question.description')</p>
                <h4 class="list-group-item-heading show-question-description">{{ $questions->first()->description }}</h4>
              </div>
              <div class="list-group-item">
                <p class="list-group-item-text">@lang('question.answer')</p>
                <h4 class="list-group-item-heading show-question-answer">{{ $questions->first()->getAnswer() }}</h4>
              </div>
            </div>
          <div class="panel-footer">
            <small>FastQuiz - @lang('home.motto')</small>
          </div>
        </div>

        </div>
        @else
          {{-- If we dont't have search results --}}
          @if (request()->has('search'))
          <div class="no-results">          
            <h2>@lang('question.no_match')</h2>
            <h2>{!! trans('question.try_again', ['url' => route('questions')]) !!}</h2>
          </div>
          @else
          <div class="col-md-8 col-md-offset-2 first-item-panel">
              <div class="panel panel-default material-box">
                <div class="panel-heading clearfix">
                  <h3 class="panel-title pull-left">@lang('question.first')</h3>
                  <div class="btn-group pull-right">
                    <a class="btn btn-danger material-box" href="{{ route('home') }}">
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
                        <textarea name="description" class="form-control material-box" rows="5" required maxlength="150" placeholder="@lang('question.choose_description')">{{ old('description') }}</textarea>
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
                          <input type="text" name="choice_a" class="form-control material-box" required maxlength="50" placeholder="@lang('question.first_choice')" value="{{ old('choice_a') }}" aria-label="choice_a"/>
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
                          <input type="text" name="choice_b" class="form-control material-box" required maxlength="50" placeholder="@lang('question.second_choice')" value="{{ old('choice_b') }}" aria-label="choice_b"/>
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
                          <input type="text" name="choice_c" class="form-control material-box" required maxlength="50" placeholder="@lang('question.third_choice')" value="{{ old('choice_c') }}" aria-label="choice_c"/>
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
                          <input type="text" name="choice_d" class="form-control material-box" required maxlength="50" placeholder="@lang('question.fourth_choice')" value="{{ old('choice_d') }}" aria-label="choice_d"/>
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
          @endif
        @endif
    </div>
</div>

@stop

@section('modal')
  @if ($questions->count() > 0)
  <div class="modal fade" id="delete-question-modal" role="dialog" aria-labelledby="question-modal-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content material-box">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="question-modal-label">@lang('question.delete_question')</h4>
        </div>
        <div class="modal-body">
          <p>@lang('question.delete_confirmation')</p>
          <form id="delete-question-form" role="form" method="POST" action="{{ route('delete-question') }}">
            {{ csrf_field() }}
            <input type="hidden" id="question-id" name="id" value="{{ $questions->first()->id }}" />
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger material-box" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> @lang('question.no')</button>
          <button type="button" id="delete-question-button" class="btn btn-success material-box"><i class="fa fa-check" aria-hidden="true"></i> @lang('question.yes')</button>
        </div>
      </div>
    </div>
  </div>
  @endif
@stop