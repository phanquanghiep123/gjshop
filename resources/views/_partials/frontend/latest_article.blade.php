

 @if(count($latestArticle) > 0)
    @if(isset($article) && $article->id != $latestArticle->id)
        <?php   
            $category = $latestArticle->categories->first();
            $link = route('detailtArticle',['categorySlug'=>$category->slug,'slug'=>$latestArticle->slug]); 
        ?>
        <div class="col-md-12 col-sm-12 col-xs-12 latest-article-holder">
            <div class="latest-article">
                <img src="{!! asset( $latestArticle->list_image ) !!}" class="img-responsive">
                <div class="article-title">
                    <a href="{{$link}}"> {!! $latestArticle->title !!} </a>
                </div>
            </div>
        </div>
    @endif
@endif