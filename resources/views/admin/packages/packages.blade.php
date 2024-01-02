@extends('adminlte::page')
@section('title', 'Packages')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>@lang('admin.package.title')</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route("admin.home")}}">@lang('admin.package.subtitle')</a></li>
                <li class="breadcrumb-item active">@lang('admin.package.subtitle2')</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
@include('flash::message')
<div class="card card-solid">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="text-left">
                    <a href="{{route('admin.packages.create')}}" class="btn btn-lg bg-success">
                        <i class="fas fa-plus-circle"></i> @lang('admin.package.create')
                    </a>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <form action="{{route('admin.packages.search')}}" method="POST">
                    @csrf
                    <div class="input-group input-group-lg">
                        <input type="text" name="search" class="form-control @error('search') is-invalid @enderror" placeholder="@lang('admin.package.search')">
                        <span class="input-group-append">
                            <button type="submit" class="btn btn-info btn-flat">@lang('admin.btn.search')</button>
                        </span>
                        @error('search')
                        <span class="error invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="text-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-lg dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                            @lang('admin.package.filter')
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('admin.packages.filter', ['parameter' => 'activated']) }}">@lang('admin.package.filterPackage.active')</a>
                            <a class="dropdown-item" href="{{ route('admin.packages.filter', ['parameter' => 'desactivated']) }}">@lang('admin.package.filterPackage.desactive')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body pb-0">
        <div class="row">
            @forelse($packages as $package)
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                <div class="card bg-light d-flex flex-fill">
                    <div class="card-header text-muted border-bottom-0">
                        {{$package->name}}
                    </div>
                    <div class="card-body pt-0">
                        <img src="{{asset('storage/'.$package->img)}}" alt="package-cover" class="img-fluid">
                        <hr>
                        {!! $package->long_description !!}
                        <div class="row pt-2">
                            {{-- <div class="col-6">
                                <p class="text-muted text-sm"><b>Price: </b> $ {{$package->price}} </p>
                            <p class="text-muted text-sm"><b>Minting Month: </b> {{$package->minting_month}} Months</p>
                            <p class="text-muted text-sm"><b>Dally Retuns: </b> {{$package->daily_returns}}%</p>
                            <p class="text-muted text-sm"><b>Bonus: </b> {{$package->bonus}}</p>
                        </div>
                        <div class="col-6">

                            <p class="text-muted text-sm"><b>Month Coins: </b> {{$package->per_month_coins}} /Month</p>
                            <p class="text-muted text-sm"><b>Capping Coins: </b> {{$package->daily_return}} /Day</p>
                            <p class="text-muted text-sm"><b>Yearly Returns: </b> {{$package->yaerly_returns}}%</p>
                            <p class="text-muted text-sm"><b>Total Returns: </b> {{$package->total_returns}}</p>


                        </div> --}}
                        <div class="col-12">
                            <p class="text-muted">@if($package->activated)<span class="badge badge-success right"> @lang('admin.package.statusAc') </span> @else<span class="badge badge-danger right"> @lang('admin.package.statusDe') </span> @endif </p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row justify-content-between">
                        <div class="text-right">
                            <form action="{{route('admin.packages.delete', ['id' => $package->id])}}" method="post">
                                <a href="{{route('admin.packages.edit', ['id' => $package->id])}}" class="btn bg-teal" title="@lang('admin.package.edit')">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" title="@lang('admin.package.delete')"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <p>@lang('admin.package.empty')</p>
        @endforelse
    </div>
</div>
<div class="row d-flex justify-content-center ">
    {{$packages->links()}}
</div>
</div>
@stop

@section('js')
<script>
    $('#flash-overlay-modal').modal();
</script>
<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
@stop