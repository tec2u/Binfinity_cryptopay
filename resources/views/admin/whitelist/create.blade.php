@extends('adminlte::page')

@section('title', 'Create Packages')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>@lang('admin.whitelist.titlecreate')</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route("admin.home")}}">@lang('admin.whitelist.subtitle')</a></li>
                <li class="breadcrumb-item"><a href="{{route("admin.whitelist.whitelist")}}">@lang('admin.whitelist.title')</a></li>
                <li class="breadcrumb-item active">@lang('admin.whitelist.subtitle2')</li>
            </ol>
        </div>
    </div>
</div>
@stop

@section('content')
@include('flash::message')
<div class="row d-flex justify-content-center ">
    <div class="col-lg-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">@lang('admin.whitelist.cardtitle')</h3>
            </div>
            <form action="{{route('admin.whitelist.store')}}" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label for="ip">IP</label>
                        <input type="text" class="form-control form-control-lg @error('ip') is-invalid @enderror" id="ip" name="ip" placeholder="@lang('admin.whitelist.table.enterip')" value="{{old('ip')}}">
                        @error('ip')
                        <span class="error invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <div class="row">
                                <div class="col md 6">
                                    <div class="form-group">
                                        <label for="activated">@lang('admin.whitelist.table.col2')</label>
                                        <select class="form-control form-control-lg @error('password') is-invalid @enderror" name="activated" id="activated">
                                            <option value="1">@lang('admin.whitelist.table.active')</option>
                                            <option value="0">@lang('admin.whitelist.table.desactive')</option>
                                        </select>
                                        @error('rule')
                                        <span class="error invalid-feedback">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn brn-lager btn-success">@lang('admin.whitelist.register')</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- @if (isset($errors) && count($errors))
     
<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }} </li>
@endforeach
</ul>

@endif --}}

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: "classic"
        });
    });
</script>
<script>
    $('#flash-overlay-modal').modal();
</script>
<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
@stop