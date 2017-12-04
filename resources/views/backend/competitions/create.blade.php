@extends('layouts.backend')


@section('breadcrumb')
<ul class="page-breadcrumb">
    <li>
        <a href="{!! route('dashboard') !!}">Dashboard</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span>Add Competition</span>
    </li>
</ul>
@stop


@section('content')
<div class="portlet light bordered xlarge-margin-top">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-file-o"></i>
            <span class="caption-subject bold uppercase"> Add Competition</span>
        </div>
        <div class="panel-nav pull-right">
            <a href="{!! route('gjadmin.competitions.index') !!}" class="btn dark">Back</a>
        </div>
    </div>
    <div class="portlet-body">
         @include('backend.competitions.form')
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