@extends('layout')

@section('title')
    FastQuiz - @lang('home.menu.my_articles')
@stop

@section('content')

<div class="container profile-container">
    <h2><a href="{{ route('articles') }}">@lang('home.menu.my_articles')</a></h2>
    @if ($articles->count() > 0)
    <a class="btn btn-primary btn-block add-item material-box" href="{{ route('create-article') }}">
      <i class="fa fa-plus"></i>
      @lang('article.create')
    </a>
    @endif
    <div class="row">
        @if ($articles->count() > 0)
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 bootcards-list">

          <div class="panel panel-default material-box">

            <div class="panel-body">
              <form method="GET" action="{{ route('articles') }}">
                <input type="hidden" name="search" value="true" />
                <div class="row">
                  <div style="padding-right:10px;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">                      
                    <div class="form-group">
                      <input type="text" class="form-control material-box" name="keywords" value="{{ Request::input('keywords', '') }}" placeholder="@lang('article.looking_for')">
                      <i class="fa fa-search"></i>
                    </div>
                  </div>                    
                </div>
                <div style="margin-top:15px;" class="row">
                  <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                    <div class="form-group">
                      {!! Form::select('category', categories(), Request::input('category', ''), ['class'=>'form-control material-box', 'placeholder' => trans('article.all_categories')]) !!}
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                    <div class="form-group">
                      {!! Form::select('status', trans('article.status'), Request::input('status', ''), ['class'=>'form-control material-box', 'placeholder' => trans('article.all_articles')]) !!}
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                    <button type="submit" class="btn btn-primary material-box">@lang('article.search')</button>
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
                    <p class="list-group-item-text">@lang('article.category'): {{ $article->getCategoryName() }}</p>
                    @include('partials.status', ['model' => $article])
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

        <div class="panel panel-default material-box">
          <div class="panel-heading clearfix">
              <a class="btn btn-danger pull-left delete-article material-box" href="javascript:void(0);" data-id="{{ $articles->first()->id }}">
                <i class="fa fa-times"></i>
                @lang('article.delete')
              </a>
              <a class="btn btn-primary pull-right edit-article material-box" href="{{ route('edit-article', ['id'=>$articles->first()->id]) }}">
                <i class="fa fa-pencil"></i>
                @lang('article.edit')
              </a>
            </div>
            <div class="list-group">
              <div class="list-group-item">
                <p class="list-group-item-text">@lang('article.category')</p>
                <h4 class="list-group-item-heading show-article-category">{{ $articles->first()->getCategoryName() }}</h4>
              </div>
              <div class="list-group-item">
                <p class="list-group-item-text">@lang('article.title')</p>
                <h4 class="list-group-item-heading show-article-title">{{ $articles->first()->title }}</h4>
              </div>
              <div class="list-group-item">
                <p class="list-group-item-text show-article-content">{{ $articles->first()->content }}</p>
              </div>
            </div>
          <div class="panel-footer">
            <small>FastQuiz - @lang('home.motto')</small>
          </div>
        </div>
        <div style="text-align:center;">
          <a class="btn btn-default slider-btn animated fadeIn play-now material-box" href="{{ route('play') }}">
            <i class="fa fa-play-circle" aria-hidden="true"></i>&nbsp;@lang('home.play')
          </a>
        </div>
        </div>
        @else
          {{-- If we dont't have search results --}}
          @if (request()->has('search'))
          <div class="no-results">          
            <h2>@lang('article.no_match')</h2>
            <h2>{!! trans('article.try_again', ['url' => route('articles')]) !!}</h2>
          </div>
          @else
          <div class="col-md-8 col-md-offset-2 first-item-panel">
              <div class="panel panel-default material-box">
                <div class="panel-heading clearfix">
                  <h3 class="panel-title pull-left">@lang('article.first')</h3>
                  <div class="btn-group pull-right">
                    <a class="btn btn-danger material-box" href="{{ route('home') }}">
                      <i class="fa fa-times"></i>
                      @lang('article.cancel')
                    </a>
                    <button class="btn btn-success item-save material-box">
                      <i class="fa fa-check"></i>
                      @lang('article.save')
                    </button>
                  </div>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal item-form" method="POST" action="{{ route('store-article') }}">

                    {{ csrf_field() }}

                    <div class="form-group">
                      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        @if ($errors->has('category'))
                        <p class="input-error">{{ $errors->first('category') }}</p>
                        @endif
                      {!! Form::select('category', categories(), old('category'), ['class'=>'form-control material-box', 'required', 'placeholder' => trans('article.choose_category')]) !!}
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                        @if ($errors->has('title'))
                        <p class="input-error">{{ $errors->first('title') }}</p>
                        @endif
                        <input type="text" name="title" class="form-control material-box" required maxlength="50" placeholder="@lang('article.choose_title')" value="{{ old('title') }}"/>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        @if ($errors->has('content'))
                        <p class="input-error">{{ $errors->first('content') }}</p>
                        @endif
                        <textarea name="content" class="form-control material-box" rows="10" required minlength="100" maxlength="1500" placeholder="@lang('article.choose_content')">{{ old('content') }}</textarea>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
                        {!! app('captcha')->display() !!}
                      </div>
                    </div>
                    
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
  @if ($articles->count() > 0)
  <div class="modal fade" id="delete-article-modal" role="dialog" aria-labelledby="article-modal-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content material-box">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="article-modal-label">@lang('article.delete_article')</h4>
        </div>
        <div class="modal-body">
          <p>@lang('article.delete_confirmation')</p>
          <form id="delete-article-form" role="form" method="POST" action="{{ route('delete-article') }}">
            {{ csrf_field() }}
            <input type="hidden" id="article-id" name="id" value="{{ $articles->first()->id }}" />
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger material-box" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> @lang('article.no')</button>
          <button type="button" id="delete-article-button" class="btn btn-success material-box"><i class="fa fa-check" aria-hidden="true"></i> @lang('article.yes')</button>
        </div>
      </div>
    </div>
  </div>
  @endif
@stop