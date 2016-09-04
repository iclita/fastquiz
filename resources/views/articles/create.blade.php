@extends('layout')

@section('title')
    FastQuiz - @lang('home.menu.my_articles')
@stop

@section('content')

<div class="container profile-container">
    <div class="row card-container">
        <div class="col-md-8 col-md-offset-2 first-item-panel">
            <div class="panel panel-default material-box">
              <div class="panel-heading clearfix">
                <h3 class="panel-title pull-left">@lang('article.add_article')</h3>
                <div class="btn-group pull-right">
                  <a class="btn btn-danger material-box" href="{{ route('articles') }}">
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
    </div>
</div>

@stop
