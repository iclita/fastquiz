@extends('layout')

@section('title')
    FastQuiz - My Articles
@stop

@section('content')

<div class="container">
    <h2>My Articles</h2>
    <div class="row">
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
              @foreach ($articles as $article)
                  @if ($id === $article->id)
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
              <a class="btn btn-danger pull-left" href="javascript:void(0);">
                <i class="fa fa-times"></i>
                Delete
              </a>
              <a class="btn btn-primary pull-right" href="{{ route('edit-article', ['id'=>$article->id]) }}">
                <i class="fa fa-pencil"></i>
                Edit
              </a>
            </div>
            <div class="list-group">
              <div class="list-group-item">
                <p class="list-group-item-text">Title</p>
                <h4 class="list-group-item-heading">{{ $article->title }}</h4>
              </div>
              <div class="list-group-item">
                <p class="list-group-item-text">Category</p>
                <h4 class="list-group-item-heading">{{ $article->getCategoryName() }}</h4>
              </div>
              <div class="list-group-item">
                <p class="list-group-item-text">{{ $article->content }}</p>
              </div>
            </div>
          <div class="panel-footer">
            <small>FastQuiz - Test your knowledge speed</small>
          </div>
        </div>

        </div>
    </div>
</div>

@stop
