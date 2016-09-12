@extends('layout')

@section('title')
    FastQuiz - Admin Zone
@stop

@section('content')

<div style="padding:25px;" class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <div style="margin-top:150px;" class="panel panel-info">
          <div class="panel-heading"><strong style="font-size:23px;">Total Articles</strong></div>
          <div class="panel-body">
            <a class="underline" href="{{ route('admin.get.articles') }}">
                <h1>{{ $total['articles'] }} Articles</h1>
            </a>
            <a class="underline" href="{{ route('admin.get.articles') }}?search=true&status=pending">
                <h2 style="color:#337ab7;">{{ $total['pending-articles'] }} Pending</h2>
            </a>
            <a class="underline" href="{{ route('admin.get.articles') }}?search=true&status=approved">
                <h2 style="color:#449d44;">{{ $total['approved-articles'] }} Approved</h2>
            </a>
            <a class="underline" href="{{ route('admin.get.articles') }}?search=true&status=rejected">
                <h2 style="color:#c9302c;">{{ $total['rejected-articles'] }} Rejected</h2>
            </a>
          </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <div style="margin-top:150px;" class="panel panel-info">
          <div class="panel-heading"><strong style="font-size:23px;">Total Questions</strong></div>
          <div class="panel-body">
            <h1>{{ $total['questions'] }} Questions</h1>
            <h2 style="color:#337ab7;">{{ $total['pending-questions'] }} Pending</h2>
            <h2 style="color:#449d44;">{{ $total['approved-questions'] }} Approved</h2>
            <h2 style="color:#c9302c;">{{ $total['rejected-questions'] }} Rejected</h2>
            <a href="{{ route('admin.get.questions') }}">
                <h1 style="float:right; margin-top:-50px;"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></h1>
            </a>
          </div>
        </div>
    </div>
</div>

@stop
