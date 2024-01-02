@extends('adminlte::page')

@section('title', 'Pool Commission')

@section('content_header')
<div class="alignHeader">
   <h4>@lang('admin.pool.title')</h4>
</div>
<i class="fa fa-home ml-3"></i> - @lang('admin.pool.subtitle')
@stop

@section('content')

<div class="card">
   <div class="card-header">
      <div class="row">
         <div class="col-sm-12 col-md-4">
            <form action="{{route('admin.reports.searchSignup')}}" method="GET">
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
            <form class="row g-3" method="GET" action="{{route('admin.reports.getDateSignup')}}">
               @csrf
               <div class="col-auto">
                  <label>@lang('admin.pool.date'):</label>
               </div>
               <div class="col">
                  <input type="date" class="form-control" name="fdate">
               </div>
               <div class="col-auto">
                  <label>@lang('admin.pool.date2'):</label>
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
      <table class="table table-hover table-bordered results">
         <thead>
            <tr>
               <th>ID</th>
               <th>@lang('admin.pool.table.col1')</th>
               <th>@lang('admin.pool.table.col2')</th>
               <th>@lang('admin.pool.table.col3')</th>
               <th>@lang('admin.pool.table.col4')</th>
            </tr>
            <tr class="warning no-result">
               <td colspan="4"><i class="fa fa-warning"></i> @lang('admin.btn.noresults')</td>
            </tr>
         </thead>
         <tbody>
            @forelse($scores as $score)
            <tr>
               <th>{{$score->id}}</th>
               <th>{{isset($score->user) ? $score->user->name : $score->name}}</th>
               <td>{{isset($score->config_bonus) ? $score->config_bonus->description : $score->description}}</td>
               <td>{{number_format($score->price,2, ',', '.')}}</td>
               <td>{{date('d/m/Y',strtotime($score->created_at))}}</td>
            </tr>
            @empty
            <p>@lang('admin.pool.table.empty')</p>
            @endforelse
         </tbody>
      </table>
   </div>
</div>
<div class="card-footer clearfix py-3">
   {{$scores->appends([
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

@stop