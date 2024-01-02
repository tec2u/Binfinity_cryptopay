@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>@lang('admin.changepassword.title')</h1>
@stop

@section('content')
@include('flash::message')
<div class="card">
     <div class="card-body">  
      <form action="{{route('admin.users.change.password')}}" method="POST">
         @csrf
         @method('PUT')
         <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-10 col-form-label">@lang('admin.changepassword.current')</label>
            <div class="col-sm-10">
               <input type="password" class="form-control" name="old_password" id="old_password">
            </div>
         </div>
         <div class="row mb-3">
            <label for="inputPassword1" class="col-sm-10 col-form-label">@lang('admin.changepassword.password')</label>
            <div class="col-sm-10">
               <input type="password" class="form-control" name="password" id="password">
            </div>
         </div>
         <div class="row mb-3">
            <label for="inputPassword2" class="col-sm-10 col-form-label">@lang('admin.changepassword.confirmation')</label>
            <div class="col-sm-10">
               <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
            </div>
         </div>

         <button type="submit" class="btn btn-warning">@lang('admin.changepassword.change')</button>
      </form>
   </div>
</div>
</section>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>$('#flash-overlay-modal').modal();</script> 
<script>
   $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
@stop
