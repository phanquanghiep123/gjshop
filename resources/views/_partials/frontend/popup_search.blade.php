<div id="popup-search">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span class="close-container" data-toggle="tooltip" data-placement="left" title="Close"> 
                    <i class="fa fa-close"></i>
                </span>
                <form action="{{route('search')}}" id="search-form" method="GET" onsubmit="Search.submit(this);return false;">
                    <input class="form-control" type="text" name="search" placeholder="Enter search term..." autofocus required/>
                    <button><i class="fa fa-search"></i></a></button>
                </form>
            </div>
        </div>
        <div class="row search-heading">
            
        </div>
        <div class="row content-search">
            
        </div>
    </div>
</div>