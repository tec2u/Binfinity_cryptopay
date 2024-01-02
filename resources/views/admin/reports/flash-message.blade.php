

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    {{$message}}
</div>
@endif


@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    {{$message}}
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
