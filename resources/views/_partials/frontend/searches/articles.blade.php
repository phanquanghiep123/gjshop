@if(count($articles))
<div class="col-sm-6 col-md-6 col-xs-12 search-section articles">
    <h3><i class="fa fa-file-text-o"></i> Articles ({{  \App\Article::whereRaw("MATCH(title,content) AGAINST(? IN BOOLEAN MODE)",array($search))->whereNull('video_link')->published()->count() }})</h3>
    <ul>
        @foreach($articles as $article)
        <?php
            $cat = $article->categories()->first();
            $parentCat = $cat->parent;
            $link = route('detailtArticle',['categorySlug'=>$cat->slug,'slug'=>$article->slug]);
        ?>
        <li>• <a href="{{$link}}">{{$article->title}}</a></li>
        @endforeach
    </ul>
    {!! $articles->appends(['search_in'=>'articles','search'=>$search])->links() !!}
</div>
@endif





