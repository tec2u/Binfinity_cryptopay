@extends('adminlte::page')

@section('title', 'Update Bonus Configuration')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@lang('admin.unilevel.titleupdate')</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route("admin.home")}}">@lang('admin.unilevel.subtitle')</a></li>
                    <li class="breadcrumb-item"><a href="{{route("admin.configBonus.list")}}">@lang('admin.unilevel.subtitle2')</a></li>
                    <li class="breadcrumb-item active">@lang('admin.unilevel.titleupdate')</li>
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
            <h3 class="card-title">@lang('admin.unilevel.cardtitle')</h3>
        </div>
        <form action="{{route('admin.configBonus.update', ['id' => $config->id])}}" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="level">@lang('admin.unilevel.table.col1')</label>
                    <input type="number" 
                        class="form-control form-control-lg @error('level') is-invalid @enderror" 
                        id="level" 
                        name="level" 
                        placeholder="1"
                        value="{{$config->level}}">
                    @error('level')
                        <span class="error invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="decription">@lang('admin.unilevel.table.description')</label>
                            <input 
                                type="text" 
                                class="form-control form-control-lg @error('decription') is-invalid @enderror" 
                                id="decription" 
                                name="decription"
                                placeholder="@lang('admin.unilevel.table.description')"
                                value="{{$config->decription}}">
                            @error('decription')
                                <span class="error invalid-feedback">{{$message}}</span>
                            @enderror
                        </div> 
                        <div class="form-group">
                            <label for="value_percent">@lang('admin.unilevel.table.col2')</label>
                            <input 
                                type="number" 
                                class="form-control form-control-lg @error('value_percent') is-invalid @enderror" 
                                id="value_percent" 
                                name="value_percent" 
                                step="0.05"
                                placeholder="2.50"
                                value="{{$config->value_percent}}">
                            @error('value_percent')
                                <span class="error invalid-feedback">{{$message}}</span>
                            @enderror
                        </div> 
                        
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user_activated">@lang('admin.unilevel.table.user')</label>
                            <input 
                                type="number" 
                                class="form-control form-control-lg @error('user_activated') is-invalid @enderror" 
                                id="user_activated" 
                                name="user_activated"
                                placeholder="1"
                                value="{{$config->user_activated}}" disabled>
                            @error('user_activated')
                                <span class="error invalid-feedback">{{$message}}</span>
                            @enderror
                        </div> 
                                                
                        <div class="form-group">
                            <label for="minimum_users">@lang('admin.unilevel.table.col6')</label>
                            <input 
                                type="number" 
                                class="form-control form-control-lg @error('minimum_users') is-invalid @enderror" 
                                id="minimum_users" 
                                name="minimum_users"
                                step="1"
                                placeholder="1"
                                value="{{$config->minimum_users}}">
                            @error('minimum_users')
                                <span class="error invalid-feedback">{{$message}}</span>
                            @enderror
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">@lang('admin.unilevel.table.col4')</label>
                            <input 
                                type="number" 
                                class="form-control form-control-lg @error('status') is-invalid @enderror" 
                                id="status" 
                                name="status" 
                                placeholder="1"
                                value="{{$config->status}}">
                            @error('status')
                                <span class="error invalid-feedback">{{$message}}</span>
                            @enderror
                        </div>  
                        <div class="form-group">
                            <label for="max_price">@lang('admin.unilevel.table.col3')</label>
                            <input 
                                type="number" 
                                class="form-control form-control-lg @error('max_price') is-invalid @enderror" 
                                id="max_price" 
                                name="max_price" 
                                step=".05"
                                placeholder="9.99"
                                value="{{$config->max_price}}">
                            @error('max_price')
                                <span class="error invalid-feedback">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>  
            <div class="card-footer text-right">
                <button type="submit" class="btn brn-lager btn-success">@lang('admin.unilevel.register')</button>
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
    <script>$('#flash-overlay-modal').modal();</script> 
    <script>
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
@stop