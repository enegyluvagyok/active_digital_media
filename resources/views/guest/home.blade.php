@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<style>
    .main-header {
        margin-left: 0 !important;
    }
</style>
@stop

@section('content')
<div class="row">
    <div class="col-9">
        <h5>Articles:</h5>
        <div class="card">
            <div class="card-body pb-0">
                <div class="row">
                    @foreach($articles as $article)
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-body pt-0"><br>
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b>{{$article->article->title}}</b></h2>
                                        <p class="text-muted text-sm" style=" white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{$article->article->intro}}</p>
                                        <p class="text-muted text-sm" style=" white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{!! $article->article->content !!}</p>
                                    </div>
                                    <div class="col-5 text-center">
                                        @if(isset($article->article->image))
                                        <img src="{{ url($article->article->image) }}" alt="article-image" class="img-circle img-fluid">
                                        @else
                                        <img src="{{asset('placeholder.jpg')}}" alt="article-image" class="img-circle img-fluid">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <a href="{{route('guest.articles.show', $article->article_id)}}" class="btn btn-sm btn-success">
                                        <i class="fas fa-eye"></i> View Article
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div>
        <h5>Categories: </h5>
        <x-category-tree />
    </div>
</div>
@stop