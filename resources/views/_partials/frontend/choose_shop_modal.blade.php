<div class="modal fade" tabindex="-1" role="dialog"  id="choose-shop-modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Choose Your Country</h4>
      </div>
      <div class="modal-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ route('shop.chooseContinent') }}">
            {!! csrf_field() !!}
            <div class="form-group">
                <div class="col-md-8">
                    <select name='continent' class="form-control">
                        <option value="EU">United Kingston</option>
                        <option value="NA">United State</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-check"></i> Ok
                    </button>
                </div>
            </div>
            <div class="form-group">
                
            </div>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->