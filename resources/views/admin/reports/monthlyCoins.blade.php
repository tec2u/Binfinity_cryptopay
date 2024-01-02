@extends('adminlte::page')

@section('title', 'Monthly Coins')

@section('content_header')
<div class="alignHeader">
   <h4>@lang('admin.coin.title')</h4>
</div>
<i class="fa fa-home ml-3"></i> - @lang('admin.coin.subtitle')
@stop

@section('content')

<div class="card">
   <div class="card-header">
      <div class="row">
         <div class="col-sm-12 col-md-4">
            <form action="{{route('admin.reports.searchMonthly')}}" method="GET">
               @csrf
               <div class="input-group input-group-lg">
                  <input type="text" name="search" class="form-control @error('search') is-invalid @enderror" placeholder="@lang('admin.btn.search')">
                  <span class="input-group-append">
                     <button type="submit" class="btn btn-info btn-flat">@lang('admin.btn.search')</button>
                  </span>
                  @error('search')
                  <span class="error invalid-feedback">{{$message}}</span>
                  @enderror
               </div>
            </form>
         </div>
         <div class="col-12 col-md-8">
            <form class="row g-3" method="GET" action="{{route('admin.reports.getDateMonthly')}}">
               @csrf
               <div class="col-auto">
                  <label>@lang('admin.coin.date'):</label>
               </div>
               <div class="col">
                  <input type="date" class="form-control" name="fdate">
               </div>
               <div class="col-auto">
                  <label>@lang('admin.coin.date2'):</label>
               </div>
               <div class="col">
                  <input type="date" class="form-control" name="sdate">
               </div>
               <input type="submit" value="Search" class="btn btn-info">
            </form>
         </div>
      </div>
   </div>
   <div class="card-body table-responsive">
      <span class="counter float-right"></span>
      <table class="table table-hover table-bordered results">
         <thead>
            <tr>
               <th>ID</th>
               <th>@lang('admin.coin.table.col1')</th>
               <th>@lang('admin.coin.table.col2')</th>
               <th>@lang('admin.coin.table.col3')</th>
               <th>@lang('admin.coin.table.col4')</th>
               <th>@lang('admin.coin.table.col5')</th>
            </tr>
            <tr class="warning no-result">
               <td colspan="4"><i class="fa fa-warning"></i> @lang('admin.btn.noresults')</td>
            </tr>
         </thead>
         <tbody>
            @forelse($monthly_coins as $monthly_coin)
            <tr>
               <td>{{$monthly_coin->id}}</td>
               <td>{{isset($monthly_coin->user) ? $monthly_coin->user->name : $monthly_coin->name}}</td>
               <td>{{isset($monthly_coin->config_bonus) ? $monthly_coin->config_bonus->description : $monthly_coin->description}}</td>
               <td>{{number_format($monthly_coin->price,2, ',', '.')}}</td>
               <td>{{$monthly_coin->order_id}}</td>
               <td>{{date('d/m/Y',strtotime($monthly_coin->created_at))}}</td>
            </tr>
            @empty
            <p class="m-4 fst-italic">@lang('admin.coin.table.empty')</p>
            @endforelse
         </tbody>
      </table>
   </div>
   <div class="card-footer clearfix py-3">
      {{$monthly_coins->appends([
         'search'=>request()->get('search',''),
         'fdate'=>request()->get('fdate',''),
         'sdate'=>request()->get('sdate',''),
      ])->links()}}
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