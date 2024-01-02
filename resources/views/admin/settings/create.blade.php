@extends('adminlte::page')

@section('title', 'Create Packages')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>@lang('admin.pageindication.title')</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route("admin.home")}}">@lang('admin.pageindication.subtitle')</a></li>
                <li class="breadcrumb-item"><a href="{{route("admin.settings.indication")}}">@lang('admin.pageindication.subtitle1')</a></li>
                <li class="breadcrumb-item active">@lang('admin.pageindication.title')</li>
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
                <h3 class="card-title">@lang('admin.pageindication.text')</h3>
            </div>
            <form action="{{route('admin.settings.store')}}" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label for="description">@lang('admin.pageindication.table.col1')</label>
                        <input type="text" class="form-control form-control-lg" id="description" name="description" placeholder="@lang('admin.pageindication.table.col1')">
                    </div>
                    <div class="form-group">
                        <label for="description">@lang('admin.pageindication.table.col2')</label>
                        <input type="text" class="form-control form-control-lg" id="img_url" name="img_url" placeholder="@lang('admin.pageindication.table.col2')">
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn brn-lager btn-success">@lang('admin.pageindication.table.register')</button>
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