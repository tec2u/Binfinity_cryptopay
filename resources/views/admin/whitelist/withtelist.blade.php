@extends('adminlte::page')

@section('title', 'White List')

@section('content_header')
<div class="alignHeader">
   <h4>@lang('admin.whitelist.title')</h4>
</div>
@stop

@section('content')

@include('flash::message')
<div class="card">
   <div class="card-header">
      <div class="text-left">
         <a href="{{route('admin.whitelist.create')}}" class="btn btn-lg bg-success" title="">
            <i class="fas fa-plus-circle"></i> @lang('admin.whitelist.create')
         </a>
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
               <th>IP</th>
               <th>@lang('admin.whitelist.table.col1')</th>
               <th>@lang('admin.whitelist.table.col2')</th>
            </tr>
            <tr class="warning no-result">
               <td colspan="4"><i class="fa fa-warning"></i>@lang('admin.btn.noresults')</td>
            </tr>
         </thead>
         <tbody>
            @forelse($whitelist as $score)
            <tr>
               <td>{{$score->id}}</td>
               <td>{{$score->ip}}</td>
               @if ($score->activated == 1)
               <td class="approvd">@lang('admin.whitelist.table.active')</td>
               @else
               <td class="text-warning">@lang('admin.whitelist.table.desactive')</td>
               @endif
               <td>
                  <div class="btn-group">
                     <button class="btn btn-warning btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Actions
                     </button>
                     <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('admin.whitelist.inactive', ['id' => $score->id])}}"><i class="fa fa-power-off"></i>&ensp;@lang('admin.whitelist.table.markdesactive')</a></li>
                        <li><a class="dropdown-item" href="{{route('admin.whitelist.activated', ['id' => $score->id])}}"><i class="fa fa-power-off"></i>&ensp;@lang('admin.whitelist.table.markactive')</a></li>
                     </ul>
                  </div>
               </td>
            </tr>
            @empty
            <p>@lang('admin.whitelist.table.empty')</p>
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
   $('#flash-overlay-modal').modal();
</script>
<script>
   $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
<script>
   $(document).ready(function() {
      $(".search").keyup(function() {
         var searchTerm = $(".search").val();
         var listItem = $('.results tbody').children('tr');
         var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

         $.extend($.expr[':'], {
            'containsi': function(elem, i, match, array) {
               return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
            }
         });

         $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e) {
            $(this).attr('visible', 'false');
         });

         $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e) {
            $(this).attr('visible', 'true');
         });

         var jobCount = $('.results tbody tr[visible="true"]').length;
         $('.counter').text(jobCount + ' item');

         if (jobCount == '0') {
            $('.no-result').show();
         } else {
            $('.no-result').hide();
         }
      });
   });
</script>
@stop