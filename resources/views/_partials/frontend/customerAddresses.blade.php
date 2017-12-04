<table id="user-addresses" class="table table-hover table-striped">
    <tbody>
        @foreach($loggedUser->addresses()->orderBy('default','DESC')->get() as $address)
        <tr>
            <td>
                <strong>{!! strtoupper($address->name) !!}</strong> @if($address->default) (Default)   @endif<br/>
                {!! $address->address !!},
                {!! $address->town !!},
                {!! $address->city !!}, {!! $address->zip_code !!},
                {!! $address->country !!}

                @if(!$address->default)
                <div class="actions pull-right">
                    <div class="btn-group">
                        <button class="btn dark btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-gear"></i>
                            <span class="caret ml5"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a class="actionButton" data-id="{{$address->id}}" data-url="{{ route('delete_address',$address->id) }}" onclick="Addresses.removeAddress(this)">
                                    <i class="glyphicon glyphicon-trash"></i> Delete Address
                                </a>
                            </li>
                            <li>
                                <a class="actionButton" data-id="{{$address->id}}" data-url="{{ route('mark_default_address',$address->id) }}" onclick="Addresses.markDefaultAddress(this)">
                                    <i class="fa fa-tag"></i> Mark as default
                                </a>
                                
                            </li>
                        </ul>
                    </div>
                </div>
                @else
                    <a class="medium-margin-left" data-toggle="popover" data-trigger="hover" data-placement="top" title="Address Information" data-content="Please note that the default address can not be deleted!">
                        <i class="fa fa-info-circle x2"></i>
                    </a>
                @endif

            </td>
        </tr>
        @endforeach
    </tbody>
</table>