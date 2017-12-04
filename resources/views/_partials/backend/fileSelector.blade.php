@if($label)
<label class="control-label" for="{{$name}}">
    {{$label}}
</label>
@endif
<div>
    <?php
    $idForHiddenField = $name . uniqid();
    ?>
    <input name="{{$name}}" value="" id="{{$idForHiddenField}}" type="hidden">
    <a href="" target="_blank" id="{{$idForHiddenField}}-label">
    </a>
    <a class="popup_selector btn btn-default {{ $cssClass ? $cssClass : '' }}" data-inputid="{{$idForHiddenField}}">
        Select Image
    </a>
</div>
