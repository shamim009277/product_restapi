
@if(Session::has('flash_message'))
  	<div class="alert alert-{{session('status_color')}} alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <i class="fa fa-times-circle"></i> {!! session('flash_message') !!}
    </div>
@endif

