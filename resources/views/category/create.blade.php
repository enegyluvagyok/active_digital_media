@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1 class="m-0 text-dark">New Category</h1>
@stop

@section('content')
<form method="POST" action="{{route('categories.store')}}">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    @csrf
                    <input name="title" type="text" class="form-control form-control-sm" placeholder="Title"><br>
                    <textarea name="description" class="form-control form-control-sm" placeholder="Description"></textarea><br>
                    <label for="active">Status:</label>
                    <select name="active" class="form-control form-control-sm col-4">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select><br>
                    <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Create category</button>

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
                        @if($otherCategory->parent_id === null)
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
        selector: 'textarea'
    });
</script>

@endpush