@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1 class="m-0 text-dark">Articles</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <a href="{{route('articles.create')}}"><button class="btn btn-sm btn-success"><i class="fas fa-plus"></i> New Article</button></a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body pb-0">
                <div class="row">
                    @foreach($articles as $article)
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card">
                            <div class="card-body pt-0"><br>
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b>{{$article->title}}</b></h2>
                                        <p class="text-muted text-sm" style=" white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{$article->intro}}</p>
                                        <p class="text-muted text-sm" style=" white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{!! $article->content !!}</p>
                                    </div>
                                    <div class="col-5 text-center">
                                        @if(isset($article->image))
                                        <img src="{{ url($article->image) }}" alt="article-image" class="img-circle img-fluid">
                                        @else
                                        <img src="{{asset('placeholder.jpg')}}" alt="article-image" class="img-circle img-fluid">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <a href="{{route('articles.show', $article->id)}}" class="btn btn-sm btn-success">
                                        <i class="fas fa-eye"></i> View Article
                                    </a>
                                    <a href="{{route('articles.edit', $article->id)}}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Edit Article
                                    </a>
                                    <button class="btn btn-sm btn-danger article-delete" data-id="{{$article->id}}"><i class="fas fa-trash"></i> Delete Article</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('js')

<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('.article-delete').click(function() {
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

@endpush