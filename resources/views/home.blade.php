@extends('layout')

@section('title')
    FastQuiz - @lang('home.motto')
@stop

@section('content')

<section id="home">
    <div id="main-carousel" class="carousel slide" data-ride="carousel"> 
        <div class="carousel-inner">
            <div class="item active"> 
                <div class="carousel-caption"> 
                    <div> 
                        <h2 class="heading animated bounceInDown home-text">FastQuiz - @lang('home.motto')</h2> 
                        <p class="animated bounceInUp home-text">@lang('home.fast')</p> 
                        @if (Auth::guest())
                        <a class="btn btn-social btn-block btn-facebook material-box" href="{{ route('register') }}">
                            <span class="fa fa-facebook"></span> <span class="fb-text">@lang('home.sign_in')</span>
                        </a>
                        @else
                        <a class="btn btn-default slider-btn animated fadeIn play-now material-box" href="{{ route('play') }}">
                            <i class="fa fa-play-circle" aria-hidden="true"></i>&nbsp;@lang('home.play')
                        </a>
                        @endif 
                    </div> 
                </div> 
            </div>
        </div>
    </div> 
</section>

<section id="services" class="parallax-section">
    <div class="container">
        <div class="row text-center">
            <div class="col-sm-8 col-sm-offset-2">
                <h2 class="title-one">@lang('home.menu.how_it_works')</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="our-service">
                    <div class="services row">
                        @foreach(trans('home.steps') as $step)
                        <div class="col-sm-4">
                            <div class="single-service">
                                {!! $step['icon'] !!}
                                <h2>{{ $step['title'] }}</h2>
                                <p>{{ $step['description'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="blog"> 
    <div class="container">
        <div class="row text-center clearfix">
            <div class="col-sm-8 col-sm-offset-2">
                <h2 class="title-one">@lang('home.menu.brain_food')</h2>
            </div>
        </div> 
        <div class="row">
            @forelse ($articles as $article)
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <div class="single-blog">
                    <a target="_blank" href="{{ $article->user->getProfile() }}">
                        <img src="{{ $article->user->getAvatar() }}" alt="{{ $article->title }}" />
                    </a>
                    <h4><strong>{{ short($article->title, 25) }}</strong></h4>
                    <div class="blog-content">
                        <p>{{ short($article->content, 100) }}</p>
                    </div>
                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#blog-{{ $article->id }}">@lang('home.read_more')</a>
                </div>
                <div class="modal fade" id="blog-{{ $article->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h2 style="text-align:center;">{{ $article->title }}</h2>
                                <p>{{ $article->content }}</p>
                            </div> 
                            <div style="text-align:center;" class="modal-footer">
                              <button type="button" class="btn btn-danger material-box" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> @lang('article.close')</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
            @empty
            <h1>NO ARTICLES YET!!!</h1>
            @endforelse
        </div> 
    </div> 
</section>

@stop

@section('footer')
<footer id="footer"> 
    <div class="container"> 
        <div class="text-center"> 
            <p>{{ date('Y') }} &copy; FastQuiz.net | @lang('home.rights')</p> 
        </div> 
    </div> 
</footer>
@stop
