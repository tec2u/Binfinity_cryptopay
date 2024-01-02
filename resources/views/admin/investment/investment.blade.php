@extends('adminlte::page')

@section('title', 'Minting Investment')

@section('content_header')
    <h4>@lang('admin.investment.title')</h4>
@stop

@section('content')

<div class="card">
   <div class="card-header">
      <h3>@lang('admin.investment.subtitle')</h3>
   </div>
   <div class="card-body table-responsive">
            <div class="form-group float-right">
               <input type="text" class="search form-control" placeholder="@lang('admin.btn.search')">
            </div>
         <span class="counter float-right"></span>
      <table class="table table-hover table-bordered results">
         <thead>
            <tr>
               <th>lang('admin.investment.table.col1')</th>
               <th>lang('admin.investment.table.col2')</th>
               <th>lang('admin.investment.table.col3')</th>
               <th>lang('admin.investment.table.col4')</th>
               <th>lang('admin.investment.table.col5')</th>
               <th>lang('admin.investment.table.col6')</th>
               <th>lang('admin.investment.table.col7')</th>
            </tr>
            <tr class="warning no-result">
               <td colspan="4"><i class="fa fa-warning"></i> No result</td>
            </tr>
         </thead>
         <tbody>
         @forelse($investments as $investment)
            <tr>
               <th>{{$investment->user_name}}</th>
               <td>{{$investment->package_name}}</td>
               <td>{{$investment->price}}</td>
               <td>{{$investment->total_returns}}</td>
               <td>{{$investment->minting_month}}</td>
               @switch($investment->payment_status)
               @case(0)
               <td><button class="btn btn-primary btn-sm m-0">Waiting Payment</button></td>
               @break
               @case(1)
               <td><button class="btn btn-primary btn-sm m-0">Active</button></td>
               @break
               @default
               <td><button class="btn btn-danger btn-sm m-0">Cancelled</button></td>
               @endswitch
               <td>{{$investment->created_at}}</td>
            </tr>
            @empty
            <p>lang('admin.investment.table.empty')</p>
            @endforelse
         </tbody>
      </table>
  </div>
</div>

@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('/css/admin_custom.css') }}">
@stop

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
