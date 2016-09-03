@extends('layout')

@section('title')
    FastQuiz - My Articles
@stop

@section('content')

<div class="container profile-container">
    <h2><a href="{{ route('articles') }}">My Articles</a></h2>
    @if ($articles->count() > 0)
    <a class="btn btn-primary btn-block add-item" href="{{ route('create-article') }}">
      <i class="fa fa-plus"></i>
      Add
    </a>
    @endif
    <div class="row">
        @if ($articles->count() > 0)
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 bootcards-list">

          <div class="panel panel-default">

            <div class="panel-body">
              <form class="form-inline" method="GET" action="{{ route('articles') }}">
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
              @foreach ($articles as $index=>$article)
                  {{-- Make the first item active --}}
                  @if ($index === 0)
                  <a class="list-group-item active show-article"
                    data-id="{{ $article->id }}" 
                    data-title="{{ $article->title }}" 
                    data-category="{{ $article->getCategoryName() }}" 
                    data-content="{{ $article->content }}"
                    href="javascript:void(0);">
                  @else
                  <a class="list-group-item show-article" 
                    data-id="{{ $article->id }}"
                    data-title="{{ $article->title }}" 
                    data-category="{{ $article->getCategoryName() }}" 
                    data-content="{{ $article->content }}"
                    href="javascript:void(0);">
                  @endif
                    <img src="{{ $article->getCategoryIcon() }}" class="img-rounded pull-left"/>
                    <h4 class="list-group-item-heading">{{ short($article->title) }}</h4>
                    <p class="list-group-item-text">Category: {{ $article->getCategoryName() }}</p>
                  </a>
              @endforeach
            </div>

          </div>

          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pagination-container">
              {!! $articles->appends($query)->links() !!}
            </div>
          </div>

        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 bootcards-cards">

        <div class="panel panel-default">
          <div class="panel-heading clearfix">
              <a class="btn btn-danger pull-left delete-article" href="javascript:void(0);" data-id="{{ $articles->first()->id }}">
                <i class="fa fa-times"></i>
                Delete
              </a>
              <a class="btn btn-primary pull-right edit-article" href="{{ route('edit-article', ['id'=>$articles->first()->id]) }}">
                <i class="fa fa-pencil"></i>
                Edit
              </a>
            </div>
            <div class="list-group">
              <div class="list-group-item">
                <p class="list-group-item-text">Title</p>
                <h4 class="list-group-item-heading show-article-title">{{ $articles->first()->title }}</h4>
              </div>
              <div class="list-group-item">
                <p class="list-group-item-text">Category</p>
                <h4 class="list-group-item-heading show-article-category">{{ $articles->first()->getCategoryName() }}</h4>
              </div>
              <div class="list-group-item">
                <p class="list-group-item-text show-article-content">{{ $articles->first()->content }}</p>
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
            <h2>Your search query did not match any articles :(</h2>
            <h2>Would you like to <a href="{{ route('articles') }}">try again</a>?</h2>
          </div>
          @else
          <div class="col-md-8 col-md-offset-2 first-item-panel">
              <div class="panel panel-default">
                <div class="panel-heading clearfix">
                  <h3 class="panel-title pull-left">Create Your First Article</h3>
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
                  <form class="form-horizontal item-form" method="POST" action="{{ route('store-article') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                        @if ($errors->has('title'))
                        <p class="input-error">{{ $errors->first('title') }}</p>
                        @endif
                        <input type="text" name="title" class="form-control" required maxlength="50" placeholder="Title (max. 50 characters)" value="{{ old('title') }}"/>
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
                    <div class="form-group">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        @if ($errors->has('content'))
                        <p class="input-error">{{ $errors->first('content') }}</p>
                        @endif
                        <textarea name="content" class="form-control" rows="10" required minlength="100" maxlength="1500" placeholder="Content (min. 100 characters and max. 1500 characters)">{{ old('content') }}</textarea>
                      </div>
                    </div>
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
  @if ($articles->count() > 0)
  <div class="modal fade" id="delete-article-modal" role="dialog" aria-labelledby="article-modal-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="article-modal-label">Delete Article</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this article?</p>
          <form id="delete-article-form" role="form" method="POST" action="{{ route('delete-article') }}">
            {{ csrf_field() }}
            <input type="hidden" id="article-id" name="id" value="{{ $articles->first()->id }}" />
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> No</button>
          <button type="button" id="delete-article-button" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Yes</button>
        </div>
      </div>
    </div>
  </div>
  @endif
@stop