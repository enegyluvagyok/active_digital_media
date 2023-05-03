@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1 class="m-0 text-dark">Edit Category</h1>
@stop

@section('content')
<form method="POST" action="{{route('categories.update', $category->id)}}">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$category->id}}">
                    <input name="title" type="text" class="form-control form-control-sm" value="{{$category->title}}" placeholder="Title"><br>
                    <textarea name="description" class="form-control form-control-sm" value="{!! $category->description !!}" placeholder="Description"></textarea><br>
                    <label for="active">Status: </label>
                    <select name="active" class="form-control form-control-sm col-4">
                        <option value="1" @if($category->active == 1) selected @endif>Active</option>
                        <option value="0" @if($category->active == 0) selected @endif>Inactive</option>
                    </select><br>
                    <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-edit"></i> Update category</button>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <ul>
                        <li><input type="radio" name="parent_id" value="0" checked> Set as new main category</li><br>
                        <p class="m-0 text-dark">Set parent category:</p><br>
                        @if(count($categories)>0)
                        @foreach($categories as $otherCategory)
                        @if($category->parent_id === null)
                        <li><input type="radio" name="parent_id" value="{{$otherCategory->id}}"> {{ $otherCategory->category->title }}</a>
                            <ul>
                                @foreach($categories as $child)
                                @if($child->parent_id === $otherCategory->id)
                                <li><input type="radio" name="parent_id" value="{{$child->id}}"> {{ $child->category->title }}</li></a>
                                @endif
                                @endforeach
                            </ul>
                        </li>
                        @endif
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</form>
@stop

@push('js')

<script src="https://cdn.tiny.cloud/1/imjndrsnko9ts61ni74zdxp1xi6a6hal5y7g6p1sdi82gwxm/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        setup: function(editor) {
            editor.on('init', function() {
                editor.setContent('{!! $category->description !!}');
            });
        }
    });
</script>

@endpush