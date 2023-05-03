<h2 class="m-0 text-dark">Related articles:</h2>
<div class="card">
    <div class="card-body">
        <div class="row">
            @foreach($relatedArticles as $article)
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                <div class="card">
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