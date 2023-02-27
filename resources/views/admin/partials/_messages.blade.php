@if(Session::has('success_message'))
	<div class="alert alert-info">
		<button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>
		{{ Session::get('success_message') }}
	</div>
@endif
@if(Session::has('error_message'))
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>
		{{ Session::get('error_message') }}
	</div>
@endif
