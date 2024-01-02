@extends('adminlte::page')

@section('title', 'Rank Commission')

@section('content_header')
<div class="alignHeader"> 
    <h4>@lang('admin.mlmlevel.title')</h4>
</div>
      <i class="fa fa-home ml-3"></i> - @lang('admin.mlmlevel.subtitle')
@stop

@section('content')

<div class="card">
   <div class="card-header">
      <div class="alignPackage">
         <h3>@lang('admin.mlmlevel.title')</h3>
      </div>
   </div>
   <div class="card-body table-responsive">
            <div class="form-group float-right">
               <input type="text" class="search form-control" placeholder="@lang('admin.btn.search')">
            </div>
         <span class="counter float-right"></span>
      <table class="table table-hover table-bordered results">
         <thead>
            <tr>
               <th>ID</th>
               <th>@lang('admin.mlmlevel.table.col1')</th>
               <th>@lang('admin.mlmlevel.table.col2')</th>
               <th>@lang('admin.mlmlevel.table.col3')</th>
               <th>@lang('admin.mlmlevel.table.col4')</th>
               <th>@lang('admin.mlmlevel.table.col5')</th>
            </tr>
            <tr class="warning no-result">
               <td colspan="4"><i class="fa fa-warning"></i> @lang('admin.btn.noresults')</td>
            </tr>
         </thead>
         <tbody>
            @forelse($scores as $score)
            <tr>
               <th>{{$score->id}}</th>
               <td>
                  <img src="{{asset('storage/pin/'.$score->pin)}}" class="img-fluid img-thumbnail imgRank" alt="...">
               </td>
               <td>{{$score->name}}</td>
               <td>{{$score->score}}</td>
               <td>{{$score->directs}}</td>
               <td>{{$score->bonus}}</td>
               </tr>
               @empty
               <p>@lang('admin.mlmlevel.table.empty')</p>
               @endforelse
         </tbody>
      </table>
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
