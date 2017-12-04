<div>
<link rel="stylesheet" type="text/css" href="{{asset('/assets/admin/assets/admin-tools/admin-forms/css/admin-forms.css')}}">

<div class="modal fade" tabindex="-1" role="dialog"  id="login-modal">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog modal-sm vertical-align-center">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
          <h3 class="modal-title">LOGIN</h3>
        </div>
        <div class="">

            <div class="admin-form theme-info" id="login">
              {!! Former::open_vertical(url('/ajax-login'),'POST')->id('login')->onsubmit('Auth.login(this);return false;') !!}
              {!! Former::token() !!}
              <div class="panel-body" style="padding-bottom:15px !important">

                <div role="alert" class="alert alert-danger signin-error" style="display: none"></div>

                {!! Former::text('email','')->classs('form-control')->placeholder('Enter Email')->required() !!}
                {!! Former::password('password','')->classs('form-control')->placeholder('Enter Password')->required() !!}
              <div class="row">
                <div class="col-xs-6">
                  <label class="switch ib switch-system mt10">
                      <input type="checkbox" name="remember" id="remember" checked="">
                      <label for="remember" data-on="YES" data-off="NO"></label><br/>
                      <span style="top:-12px !important;">Remember me</span>
                  </label>
                </div>
                <div class="col-xs-6">
                  <button type="submit" style="background-color: #7E9E24 !important; color:#fff !important;" class="btn btn-success pull-right">
                     Log In <i class="fa fa-btn fa-sign-in"></i>
                  </button>
                </div>
              </div>
              {!! Former::close() !!}
            </div>
          

        </div>
        <div class="modal-footer">
          <div class="row">
            <div class="col-xs-6">
              <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
            </div>
            <div class="col-xs-6">
              <a class="btn btn-link" href="{{ url('/register') }}">Register</a>
            </div>
          </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.vertical-alignment-helper -->
</div><!-- /.modal -->
</div>




