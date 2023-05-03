@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1 class="m-0 text-dark">New Article</h1>
@stop

@section('content')
<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" name="formName" action="{{route('articles.store')}}">
                    @csrf
                    <label for="title">Title:</label>
                    <input type="text" class="form-control form-control-sm" name="title"><br>
                    <label for="intro">Intro:</label>
                    <input type="text" class="form-control form-control-sm" name="intro"><br>
                    <label for="content">Content:</label>
                    <textarea class="form-control form-control-sm" style="height: 200px;" name="content"></textarea><br>
                    <label for="category">Category:</label>
                    <select name="category[]" class="form-control form-control form-control-sm col-sm-4" multiple>
                    @foreach($categories as $category)
                    <option value="{{$category->category->id}}">{{$category->category->title}}</option>
                    @endforeach
                    </select>
                    <br>
                    <span style="display: flex;">
                        <span>
                            <label for="publish_start">Publish start:</label>
                            <input type="date" class="form-control form-control-sm" name="publish_start">
                        </span>&nbsp;
                        <span>
                            <label for="publish_end">Publish end:</label>
                            <input type="date" class="form-control form-control-sm" name="publish_end">
                        </span>
                    </span><br>
                    <span style="display: flex;">
                        <span>
                            <label for="view">View: </label>
                            <select name="view" class="form-control form-control form-control-sm">
                                <option>default</option>
                            </select>
                        </span>&nbsp;
                        <span>
                            <label for="image">Image: </label>
                            <input type="file" name="image" accept="image/png, image/jpeg" class="form-control form-control-sm form-control-file">
                        </span>
                    </span><br>
                    <input type="hidden" id="parameters" name="parameters">
                    <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Create article</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-4">
        <x-articles.article-config :categories=$categories :articleService="$articleService" />
    </div>
</div>
@stop

@push('js')

<script src="https://cdn.tiny.cloud/1/imjndrsnko9ts61ni74zdxp1xi6a6hal5y7g6p1sdi82gwxm/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>tinymce.init({selector:'textarea'});</script>

@endpush