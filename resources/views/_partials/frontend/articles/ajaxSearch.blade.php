@if(count($articles))
<ul>
    <?php
        $highlighter = new App\Services\HighlightSearchService(['title','content'],$search);
        $highlighter->setNeedCutString(['content']);
    ?>
    @foreach($articles as $article)
    <li>
        <a href="{{route('detailtArticle',['categorySlug'=>$category->slug,'slug'=>$article->slug])}}">
            <?php
                $highlighter->setObject($article);
                $highlighter->highlight();
            ?>
            <p><strong>{!! $article->title !!}</strong></p>
            {!! $article->content !!}
        </a>
    </li>
    @endforeach
</ul>
@endif