@extends('adminlte::page')

@section('title', 'Withdraw Requests')

@section('content_header')
    <h4>@lang('admin.withdrawlog.title')</h4>
@stop

@section('content')

<div class="card">
   <div class="card-header">
      <div class="alignPackage">
         <h3>@lang('admin.withdrawlog.subtitle')</h3>
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
               <th>#</th>
               <th>@lang('admin.withdrawlog.details.col1')</th>
               <th>@lang('admin.withdrawlog.details.col2')</th>
               <th>@lang('admin.withdrawlog.details.col3')</th>
               <th>@lang('admin.withdrawlog.details.col4')</th>
               <th>@lang('admin.withdrawlog.details.col5')</th>
               <th>@lang('admin.withdrawlog.details.col6')</th>
               <th>@lang('admin.withdrawlog.details.col7')</th>
               <th>@lang('admin.withdrawlog.details.col8')</th>
            </tr>
            <tr class="warning no-result">
               <td colspan="4"><i class="fa fa-warning"></i>@lang('admin.btn.noresults')</td>
            </tr>
         </thead>
         <tbody>
            @forelse($withdraws as $withdraw)
            <tr>
               <th>{{$withdraw->id}}</th>
               <td>{{$withdraw->user->name}}</td>
               <td>{{$withdraw->value}}</td>
               <td>{{$withdraw->created_at}}</td>
               <td>{{$withdraw->date_payment}}</td>
               <td>{{$withdraw->message}}</td>
               <td>{{$withdraw->userPayment($withdraw)}}</td>
               <td>{{$withdraw->payment_code}}</td>
               <td>
                  @if(!$withdraw->status)
                     <button class="btn btn-primary btn-sm m-0">pending</button>
                  @else
                     <button class="btn btn-success btn-sm m-0">paid</button>
                  @endif
               </td>
            </tr>
            @empty
            <p>@lang('admin.withdrawlog.details.empty')</p>
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
