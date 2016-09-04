@extends('layout')

@section('title')
    FastQuiz - My Questions
@stop

@section('content')

<div class="container profile-container">
    <h2><a href="{{ route('questions') }}">My Questions</a></h2>
    @if ($questions->count() > 0)
    <a class="btn btn-primary btn-block add-item" href="{{ route('create-question') }}">
      <i class="fa fa-plus"></i>
      Add
    </a>
    @endif
    <div class="row">
        @if ($questions->count() > 0)
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 bootcards-list">

          <div class="panel panel-default">

            <div class="panel-body">
              <form class="form-inline" method="GET" action="{{ route('questions') }}">
                <input type="hidden" name="search" value="true" />
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                    <div class="form-group">
                      <input type="text" class="form-control" name="keywords" value="{{ Request::input('keywords', '') }}" placeholder="What are you looking for?">
                      <i class="fa fa-search"></i>
                    </div>
                    <div class="form-group">
                      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                      {!! Form::select('category', categories(), Request::input('category', ''), ['class'=>'form-control', 'placeholder' => 'All categories']) !!}
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
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
                    <p class="list-group-item-text">Category: {{ $question->getCategoryName() }}</p>
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

        <div class="panel panel-default">
          <div class="panel-heading clearfix">
              <a class="btn btn-danger pull-left delete-question" href="javascript:void(0);" data-id="{{ $questions->first()->id }}">
                <i class="fa fa-times"></i>
                Delete
              </a>
              <a class="btn btn-primary pull-right edit-question" href="{{ route('edit-question', ['id'=>$questions->first()->id]) }}">
                <i class="fa fa-pencil"></i>
                Edit
              </a>
            </div>
            <div class="list-group">
              <div class="list-group-item">
                <p class="list-group-item-text">Category</p>
                <h4 class="list-group-item-heading show-question-category">{{ $questions->first()->getCategoryName() }}</h4>
              </div>
              <div class="list-group-item">
                <p class="list-group-item-text">Question</p>
                <h4 class="list-group-item-heading show-question-description">{{ $questions->first()->description }}</h4>
              </div>
              <div class="list-group-item">
                <p class="list-group-item-text">Answer</p>
                <h4 class="list-group-item-heading show-question-answer">{{ $questions->first()->getAnswer() }}</h4>
              </div>
            </div>
          <div class="panel-footer">
            <small>FastQuiz - Test your knowledge speed</small>
          </div>
        </div>

        </div>
        @else
          {{-- If we dont't have search results --}}
          @if (request()->has('search'))
          <div class="no-results">          
            <h2>Your search query did not match any questions :(</h2>
            <h2>Would you like to <a href="{{ route('questions') }}">try again</a>?</h2>
          </div>
          @else
          <div class="col-md-8 col-md-offset-2 first-item-panel">
              <div class="panel panel-default">
                <div class="panel-heading clearfix">
                  <h3 class="panel-title pull-left">Create Your First Question</h3>
                  <div class="btn-group pull-right">
                    <a class="btn btn-danger" href="{{ route('home') }}">
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
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        @if ($errors->has('description'))
                        <p class="input-error">{{ $errors->first('description') }}</p>
                        @endif
                        <textarea name="description" class="form-control" rows="5" required maxlength="150" placeholder="Description (max. 150 characters)">{{ old('description') }}</textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        @if ($errors->has('category'))
                        <p class="input-error">{{ $errors->first('category') }}</p>
                        @endif
                        {!! Form::select('category', categories(), old('category'), ['class'=>'form-control', 'required', 'placeholder' => 'Choose a category']) !!}
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
          @endif
        @endif
    </div>
</div>

@stop

@section('modal')
  @if ($questions->count() > 0)
  <div class="modal fade" id="delete-question-modal" role="dialog" aria-labelledby="question-modal-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="question-modal-label">Delete Question</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this question?</p>
          <form id="delete-question-form" role="form" method="POST" action="{{ route('delete-question') }}">
            {{ csrf_field() }}
            <input type="hidden" id="question-id" name="id" value="{{ $questions->first()->id }}" />
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> No</button>
          <button type="button" id="delete-question-button" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Yes</button>
        </div>
      </div>
    </div>
  </div>
  @endif
@stop