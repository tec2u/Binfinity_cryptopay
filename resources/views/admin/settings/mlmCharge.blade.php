@extends('adminlte::page')

@section('title', 'Charges & Fees')

@section('content_header')
<div class="alignHeader"> 
    <h4>@lang('admin.mlm.title')</h4>
</div>
      <i class="fa fa-home ml-3"></i> - @lang('admin.mlm.subtitle')
@stop

@section('content')

<div class="card">
   <div class="card-header">
      <div class="alignPackage">
         <h3>@lang('admin.mlm.subtitle1')</h3>
      </div>
   </div>
   <div class="card-body">
      <form class="row g-3">
         <div class="col-md-4">
            <label class="form-label">@lang('admin.mlm.table.col1') *</label>
            <input type="text" class="form-control">
         </div>
         <div class="col-md-4">
            <label class="form-label">@lang('admin.mlm.table.col2') (in %) *</label>
            <input type="text" class="form-control" >
         </div>
         <div class="col-md-4">
            <label class="form-label">@lang('admin.mlm.table.col3') (in days) *</label>
            <input type="text" class="form-control" >
         </div>
         <div class="col-md-4">
            <label class="form-label">@lang('admin.mlm.table.col4') (in %) *</label>
            <input type="text" class="form-control" >
         </div>
         <div class="col-md-4">
            <label class="form-label">@lang('admin.mlm.table.col5') *</label>
            <input type="text" class="form-control" >
         </div>
         <div class="col-md-4">
            <label class="form-label">@lang('admin.mlm.table.col6') *</label>
            <input type="text" class="form-control" >
         </div>
         <div class="col-12 mt-3 btnCharge">
            <button type="submit" class="btn btn-warning">@lang('admin.mlm.table.save')</button>
         </div>
      </form>
  </div>
</div>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('/css/admin_custom.css') }}">
@stop
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
@section('js')
    <script>
        $(document).ready(function() {
  $(".search").keyup(function () {
    var searchTerm = $(".search").val();
    var listItem = $('.results tbody').children('tr');
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    
  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
  });
    
  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','false');
  });

  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','true');
  });

  var jobCount = $('.results tbody tr[visible="true"]').length;
    $('.counter').text(jobCount + ' item');

  if(jobCount == '0') {$('.no-result').show();}
    else {$('.no-result').hide();}
		  });
});
    </script>
@stop
