@extends('layout')

@section('title')
    FastQuiz - My Articles
@stop

@section('content')

<div class="container">
    <h2>My Articles</h2>
    <div class="row">
        @if ($articles->count() > 0)
        <div class="col-sm-5 bootcards-list">

          <div class="panel panel-default">

            <div class="panel-body">
              <form>
                <div class="row">
                  <div class="col-xs-9">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Search Articles...">
                      <i class="fa fa-search"></i>
                    </div>
                  </div>
                  <div class="col-xs-3">
                    <a class="btn btn-primary btn-block" href="{{ route('create-article') }}">
                      <i class="fa fa-plus"></i>
                      Add
                    </a>
                  </div>
                </div>
              </form>
            </div>

            <div class="list-group">
              @foreach ($articles as $index=>$article)
                  {{-- Make the first item active --}}
                  @if ($index === 0)
                  <a class="list-group-item active" href="javascript:void(0);">
                  @else
                  <a class="list-group-item" href="{{ route('show-article', ['id' => $article->id]) }}">
                  @endif
                    <img src="{{ $article->getCategoryIcon() }}" class="img-rounded pull-left"/>
                    <h4 class="list-group-item-heading">{{ $article->title }}</h4>
                    <p class="list-group-item-text">Category: {{ $article->getCategoryName() }}</p>
                  </a>
              @endforeach
            </div>

          </div>

        </div>
        <div class="col-sm-7 bootcards-cards">

        <div class="panel panel-default">
          <div class="panel-heading clearfix">
              <a class="btn btn-danger pull-left delete-article" href="javascript:void(0);" data-id="{{ $articles[0]->id }}">
                <i class="fa fa-times"></i>
                Delete
              </a>
              <a class="btn btn-primary pull-right" href="{{ route('edit-article', ['id'=>$articles[0]->id]) }}">
                <i class="fa fa-pencil"></i>
                Edit
              </a>
            </div>
            <div class="list-group">
              <div class="list-group-item">
                <p class="list-group-item-text">Title</p>
                <h4 class="list-group-item-heading">{{ $articles[0]->title }}</h4>
              </div>
              <div class="list-group-item">
                <p class="list-group-item-text">Category</p>
                <h4 class="list-group-item-heading">{{ $articles[0]->getCategoryName() }}</h4>
              </div>
              <div class="list-group-item">
                <p class="list-group-item-text">{{ $articles[0]->content }}</p>
              </div>
            </div>
          <div class="panel-footer">
            <small>FastQuiz - Test your knowledge speed</small>
          </div>
        </div>

        </div>
        @else
        <div class="col-md-6 col-md-offset-3 first-item-panel">
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
    </div>
</div>

@stop

@section('modal')
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
          <input type="hidden" id="article-id" name="id" value="" />
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> No</button>
        <button type="button" id="delete-article-button" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Yes</button>
      </div>
    </div>
  </div>
</div>
@stop