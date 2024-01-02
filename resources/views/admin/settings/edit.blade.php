@extends('adminlte::page')

@section('title', 'Level Commission')

@section('content_header')
<div class="alignHeader"> 
    <h4>@lang('admin.levelcommission.title')</h4>
</div>
      <i class="fa fa-home ml-3"></i> - @lang('admin.levelcommission.subtitle')
@stop

@section('content')

<div class="card">
   <div class="card-header">
      <div class="alignPackage">
         <h3>@lang('admin.levelcommission.title')</h3>
      </div>
   </div>
         <div class="card-body">
            <form action="{{route("admin.settings.update", ['id' => $scores->id])}}" method="POST" class="row g-3">
            @csrf
            @method('PUT')
                     <div class="col-md-6">
                        <label class="form-label">@lang('admin.levelcommission.table.col1') [%] *</label>
                        <input type="text" value="{{ $scores-> score}}"  id="score" name="score" class="form-control" >
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">@lang('admin.levelcommission.table.col2') *</label>
                        <input type="text" value="{{ $scores-> bonus}}"  id="bonus" name="bonus" class="form-control">
                     </div>
                  <button type="submit" class="btn btn-warning mt-2 ml-2">@lang('admin.levelcommission.table.update')</button>
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
