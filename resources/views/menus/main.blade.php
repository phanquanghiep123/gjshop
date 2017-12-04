<ul>
<?php
foreach ($menu->items as $item):
    $link = \App\Engine\Menu::generateLinkFromItem($item);
    ?>
    @if($item['type'] == \App\Menu::CATEGORY_ITEM_TYPE)
        <?php
            $cat = App\Category::find($item['id']);
        ?>
        @if($cat->isParentMenu())
        <li> {!! $link !!}
            <div class="sub-menu">
                <div class="row inner-submenu">
                    <div class="col-sm-3 list-submenu">
                        <ul>
                            @foreach($cat->childs as $child)
                            <li><a href="{{url("{$cat->slug}/{$child->slug}")}}">{{$child->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-sm-9 column-submenu">
                        <ul class="row">
                            @foreach($cat->childs as $child)
                            <li class="col-sm-4">
                                <a href="{{url("{$cat->slug}/{$child->slug}")}}"><img src="{{asset($child->list_image)}}" alt="{{$child->name}}" /></a>
                                <div class="sub-info">
                                    <h3><a href="{{url("{$cat->slug}/{$child->slug}")}}">{{$child->name}}</a></h3>
                                    <p>{{$child->description}}</p>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </li>
        @else 
        <li>{!! $link !!}</li>
        @endif
    @else
    <li>{!! $link !!}</li>
    @endif
    <?php endforeach; ?>
</ul>
