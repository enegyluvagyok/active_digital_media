@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1 class="m-0 text-dark">{{$article->title}}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-10">
        <div class="card">
            <div class="card-body">
                <div>{{$article->intro}}</div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div>{!! $article->content !!}</div>
            </div>
        </div>
    </div>
    <div class="col-2">
        <div class="card">
            <div class="card-body">
                @if(isset($article->image))
                <img src="{{ url($article->image) }}" alt="{{$article->title}}" class="img-fluid">
                @else
                <img src="{{asset('placeholder.jpg')}}" alt="{{$article->title}}" class="img-fluid">
                @endif
            </div>
        </div>
        <div class="text-center">
            <a href="{{route('articles.edit', $article->id)}}" class="btn btn-sm btn-primary">
                <i class="fas fa-edit"></i> Edit Article
            </a>
            <button class="btn btn-sm btn-danger" id="article-delete" data-id="{{$article->id}}"><i class="fas fa-trash"></i> Delete Article</button>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <x-articles.related-articles :relatedArticles=$relatedArticles :config=$config/>
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