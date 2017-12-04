@if($label)
<label class="control-label" for="{{$name}}">
    {{$label}}
</label>
@endif
<div>
    <?php
    $idForHiddenField = $name . uniqid();
    ?>
    <input name="{{$name}}" value="{{$file}}" id="{{$idForHiddenField}}" type="hidden">
    <a href="{{url($file)}}" target="_blank" id="{{$idForHiddenField}}-label">
        @if($type === 'image')
        <img src="{{url($file)}}" alt='{{$file}}' width="80" />
        @else 
        {{$file}}
        @endif
    </a>
    <a class="popup_selector btn btn-default {{ $cssClass ? $cssClass : '' }}" data-inputid="{{$idForHiddenField}}">
        Select Image
    </a>

</div>