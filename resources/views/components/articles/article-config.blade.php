<div class="card">
    <div class="card-body">
        <h5 class="card-title">Article config</h5><br>
        <form>
            @if($articleService->userHasPermission('category'))
            <label for="category">Categories:</label><br>
            <select name="category[]" class="form-control form-control-sm" multiple>
                @foreach($categories as $category)
                <option value="{{$category->category->id}}">{{$category->category->title}}</option>
                @endforeach
            </select>
            <br>
            @endif
            @if($articleService->userHasPermission('sort_by'))
            <label for="sort_by">Sort by:</label><br>
            <select name="sort_by" id="sort_by" class="form-control form-control-sm">
                <option value="id">id</option>
                <option value="publish_start">publish_start</option>
            </select>
            <br>
            @endif
            @if($articleService->userHasPermission('date'))
            <label for="datetype">Date fiter:</label>
            <input type="radio" name="datetype" id="single" value="single" checked> Single
            <input type="radio" name="datetype" id="range" value="range"> Range
            <div id="single-div">
                <span style="display: flex;">
                    <span>
                        <label for="publish_start">Created at:</label>
                        <input type="date" class="form-control form-control-sm" name="date">
                    </span>
                </span>
            </div>
            <div id="range-div" style="display: none;">
                <span style="display: flex;">
                    <span>
                        <label for="publish_start">Created at start:</label>
                        <input type="date" class="form-control form-control-sm" name="date[start]">
                    </span>&nbsp;
                    <span>
                        <label for="publish_end">Created at end:</label>
                        <input type="date" class="form-control form-control-sm" name="date[end]">
                    </span>
                    <br>
                </span>
            </div>
            <br>
            @endif
            @if($articleService->userHasPermission('show_category'))
            <label for="showcategory">Show category:</label>
            <input type="checkbox" name="showcategory">
            <br>
            @endif
            @if($articleService->userHasPermission('show_image'))
            <label for="showimg">Show image:</label>
            <input type="checkbox" name="showimg">
            <br>
            @endif
            @if($articleService->userHasPermission('show_category'))
            <label for="limit">Limit: </label>
            <select name="limit" id="limit" class="form-control form-control-sm col-sm-3">
                <option value="3">3</option>
                <option value="5">5</option>
            </select>
            <br>
            @endif
            <button type="button" id="post" class="btn btn-sm btn-success"><i class="fas fa-cog"></i> Set config</button>
        </form>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#single').click(function() {

            $('input[type=date]').each(function resetDate() {
                this.value = null;
            });

            if ($(this).is(':checked')) {
                $('#single-div').show();
                $('#range-div').hide();
            } else {
                $('#single-div').show();
                $('#range-div').hide();
            }
        });

        $('#range').click(function() {

            $('input[type=date]').each(function resetDate() {
                this.value = null;
            });

            if ($(this).is(':checked')) {
                $('#range-div').show();
                $('#single-div').hide();
            } else {
                $('#range-div').hide();
                $('#single-div').show();
            }
        });

        $("#post").click(function() {
            $.post("{{route('article.config')}}", {
                    _token: "{{ csrf_token() }}",
                    categories: $("select[name='category[]']").val(),
                    sort_by: $("select[name='sort_by']").val(),
                    date: $("input[name='date']").val(),
                    show_image: $("input[name='showimg']").is(":checked"),
                    show_category: $("input[name='showcategory']").is(":checked"),
                    date_start: $("input[name='date[start]']").val(),
                    date_end: $("input[name='date[end]']").val(),
                    limit: $("select[name='limit']").val(),
                }).done(function(response) {
                    json = JSON.stringify(response);
                    $('input[name="parameters"]').val(json);
                    alert('New config will get stored on creation.');
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.responseJSON.message);
                })
        })


    });
</script>