@extends('layouts.backend')

@section('heading')
<ol class="breadcrumb">
  <li><a href="{!! route('dashboard') !!}">Dashboard</a></li>
  <li><a href="{!! route('gjadmin.competitions.index') !!}">Edit Competition</a></li>
  <li class="active">{!! $competition->name !!}</li>
</ol>
@stop

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Edit Page: {!! $competition->title !!}
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('gjadmin.competitions.index') !!}" class="btn btn-default">All Competitions</a>
                <a href="{!! route('gjadmin.competitions.show',$competition->id) !!}" class="btn btn-default">Admin View</a>
            </div>
        </div>
        <div class="panel-body">
            @include('backend.competitions.form', ['model' => $competition])
        </div>
    </div>

@stop


@section('scripts')

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('/assets/backend/pages/scripts/components-form-tools.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/backend/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/backend/pages/scripts/components-select2.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
$('#status').change(function () {
    var status = $(this).val();
    console.log(typeof status);
    if (status === "1") {
        $('#post-date-wrapper').show();
    } else {
        $('#post-date-wrapper').val("");
        $('#post-date-wrapper').hide();
    }
});

</script>
@endsection