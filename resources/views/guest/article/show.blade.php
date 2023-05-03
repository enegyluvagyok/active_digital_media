@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<style>
    .main-header {
        margin-left: 0 !important;
    }
</style>
<h1 class="m-0 text-dark">{{$article->article->title}}</h1>
@stop

@section('content')
<style>
    .content-wrapper {
        margin-left: 0 !important;
    }
</style>
<div class="row">
    <div class="col-11">
        <div class="card">
            <div class="card-body">
                <div>{{$article->article->intro}}</div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div>{!! $article->article->content !!}</div>
            </div>
        </div>
    </div>
    <div class="col-1">
        <div class="card">
            <div class="card-body">
                @if(isset($article->article->image))
                <img src="{{ url($article->article->image) }}" alt="{{$article->article->title}}" class="img-fluid">
                @else
                <img src="{{asset('placeholder.jpg')}}" alt="{{$article->article->title}}" class="img-fluid">
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <x-articles.related-articles-guest :relatedArticles=$relatedArticles :config=$config />
    </div>
</div>
@stop

<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#article-delete').click(function() {
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: "/articles/" + id,
                dataType: 'json',
                data: {
                    id: id,
                    _method: 'DELETE',
                    _token: "{{ csrf_token() }}"
                }
            }).done(function(response) {
                alert(response);
                location.reload();
            }).fail(function(response) {
                alert(response);
            });
        });
    });
</script>