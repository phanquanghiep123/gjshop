@if(count($pages))
    <div class="col-sm-6 col-md-6 col-xs-12 search-section articles">
        <h3><i class="fa fa-file-text-o"></i> Pages ({{  \App\Page::whereRaw( "MATCH(title,content) AGAINST(? IN BOOLEAN MODE)", array($search) )->active()->count() }})</h3>
        <ul>
            @foreach($pages as $page)
            <?php

                $link = url($page->slug);
            ?>
            <li>• <a href="{{$link}}">{{$page->title}}</a></li>
            @endforeach
        </ul>
        {!! $pages->appends(['search_in'=>'pages','search'=>$search])->links() !!}
    </div>
@endif



