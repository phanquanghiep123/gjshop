@extends('layouts.customer_service')

@section('title') {{$page->title}} @stop
@section('meta_title') {{$page->title}} @stop
@section('meta_keywords') {{$page->meta_keywords}} @stop
@section('meta_description') {{$page->meta_description}} @stop

<?php 

$all = \App\FaqCategory::with(array('questions' => function($query)
        {
            $query->active();
        }))->active()->orderBy('order','ASC')->get();

 ?>

@section('content')

@include('_partials.frontend.admin_page_edit_link')

<div class="row">
    <div class="col-md-12">
        <div class="page-title-article">
            <h2 class="page-title no-margin-top">{{$page->title}}</h2>
        </div>
    </div>
</div>

@if($page->show_top_share_icons == '1')
    @include('_partials.frontend.share_icons')
@endif

<div class="inner-article-page row">
    <div class="col-md-12">
        {!! $page->content !!}
        <hr class="dashed"/>
    </div>
</div>
<div class="row" id="faqs_page">
    <div class="col-md-4">
        <ul class="ver-inline-menu tabbable margin-bottom-10">
          <?php $pos = 1; ?>
          @foreach($all as $key => $category )
            @if( count($category->questions) != 0)
              <li <?php echo ( $pos == 1 ?  'class="active"'  : 'class=""'  )  ?>>
                  <a data-toggle="tab" href="#tab_{{ $category->id }}">{{ $category->name }}</a>
              </li>
              <?php $pos++ ?>
            @endif
          @endforeach
        </ul> 
    </div>

    <div class="col-md-8">

        <div class="tab-content">
          <!-- START TAB 1 -->
          <?php $active_tab = 1; ?>
          @foreach($all as $key => $category )
          @if( count($category->questions) != 0 )
          <div id="tab_{{ $category->id }}" class="tab-pane <?php if($active_tab == 1) echo 'active'; ?>">
             <div id="accordion{{ $category->id }}" class="panel-group">

                <?php $count =1; ?>  
                @foreach($category->questions()->orderBy('order','ASC')->get() as $key => $question )
                <div class="panel panel-default">
                   <div class="panel-heading">
                      <h4 class="panel-title">
                         <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion{{ $category->id }}" href="#accordion1_{{ $question->id }}">
                          {{ $question->question }}
                         </a>
                      </h4>
                   </div>
                   <div id="accordion1_{{ $question->id }}" class="panel-collapse collapse {{ $key == 0 ? 'in' : '' }}">
                      <div class="panel-body">
                         {!! $question->answer !!}
                      </div>
                   </div>
                </div>
                 @endforeach
             </div>
          </div>
          <?php $active_tab++ ?>
          @endif
          @endforeach
          <!-- END TAB 1 -->
         
        </div>
       
    </div>            
</div>

<script type="text/javascript">

if ($('.accord-toggle').attr('aria-expanded') === "true") {
   $(this).find(".panel-heading").addClass("open");

}

</script>


@if($page->show_bottom_share_icons == '1')
    @include('_partials.frontend.share_icons')
@endif

@endsection



