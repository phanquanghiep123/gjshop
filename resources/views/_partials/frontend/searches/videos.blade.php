@if(count($videos))
<div class="col-sm-6 col-md-6 col-xs-12 search-section articles">
    
    <h3><i class="glyphicon glyphicon-facetime-video"></i> Videos ({{  \App\Article::whereRaw("MATCH(title,content) AGAINST(? IN BOOLEAN MODE)",array($search))->where('video_link','!=','')->published()->count() }})</h3>

    <ul>
        @foreach($videos as $video)
        <?php
            $cat = $video->categories()->first();
            $parentCat = $cat->parent;
            $link = route('detailtArticle',['categorySlug'=>$cat->slug,'slug'=>$video->slug]);
        ?>
        <li>• <a href="{{$link}}">{{$video->title}}</a></li>
        @endforeach
    </ul>
    {!! $videos->appends(['search_in'=>'videos','search'=>$search])->links() !!}
</div>
@endif