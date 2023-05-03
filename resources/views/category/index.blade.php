@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1 class="m-0 text-dark">Categories</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <a href="{{route('categories.create')}}"><button class="btn btn-sm btn-success"><i class="fas fa-plus"></i> New Category</button></a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-solid">
                    <theead>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </theead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{$category->category->id}}</td>
                            <td>{{$category->category->title}}</td>
                            <td>{!! $category->category->description !!}</td>
                            <td>{{$category->category->active}}</td>
                            <td>
                                <span style="display: flex;">
                                    <a href="{{route('categories.edit', $category->category->id)}}"><button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</button></a> &nbsp;
                                    <button class="btn btn-sm btn-danger category-delete" data-id="{{$category->category->id}}"><i class="fas fa-trash"></i> Delete</button>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@push('js')

<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('.category-delete').click(function() {
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: "/categories/" + id,
                dataType: 'json',
                data: {
                    id: id,
                    _method: 'DELETE',
                    _token: "{{ csrf_token() }}"
                }
            }).done(function(response) {
                console.log(response);
                alert(response);
                location.reload();
            }).fail(function(response) {
                console.log(response);
                alert(response);
            });
        });
    });
</script>

@endpush