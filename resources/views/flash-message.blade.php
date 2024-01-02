@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible alert-dismissible fade show mb-0" role="alert">

	<strong>@lang{{ $message }}</strong>
	<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
	</button>
</div>
@endif


@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible alert-dismissible fade show mb-0">

	<strong>@lang{{ $message }}</strong>
	<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
        
	</button>	
</div>
@endif


@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-dismissible alert-dismissible fade show mb-0">

	<strong>@lang{{ $message }}</strong>
	<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
	</button>
</div>
@endif


@if ($message = Session::get('info'))
<div class="alert alert-info alert-dismissible alert-dismissible fade show mb-0">

	<strong>@lang{{ $message }}</strong>
	<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
	</button>
</div>
@endif


@if ($errors->any())
<div class="alert alert-danger alert-dismissible alert-dismissible fade show mb-0">

	<strong>Please check the form below for errors</strong>
	<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
	</button>
</div>
@endif