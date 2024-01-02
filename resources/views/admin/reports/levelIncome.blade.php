@extends('adminlte::page')

@section('title', 'Level Income')

@section('content_header')
<div class="alignHeader">
   <h4>@lang('admin.level.title')</h4>
</div>
<i class="fa fa-home ml-3"></i> - @lang('admin.level.subtitle')
@stop

@section('content')

<div class="card">
   <div class="card-header">
      <div class="alignPackage">
         <h3>@lang('admin.level.subtitle2')</h3>
      </div>
   </div>
   <div class="card-body table-responsive">
      <div class="row">
         <div class="col-sm-12 col-md-4">
            <form action="{{route('admin.reports.searchLevelIncome')}}" method="GET">
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
            <form class="row g-3" method="GET" action="{{route('admin.reports.getDateLevelIncome')}}">
               @csrf
               <div class="col-auto">
                  <label>@lang('admin.level.date'):</label>
               </div>
               <div class="col">
                  <input type="date" class="form-control" name="fdate">
               </div>
               <div class="col-auto">
                  <label>@lang('admin.level.date2'):</label>
               </div>
               <div class="col">
                  <input type="date" class="form-control" name="sdate">
               </div>
               <input type="submit" value="Search" class="btn btn-info">
            </form>
         </div>
      </div>
      <table class="table table-hover table-bordered results">
         <thead>
            <tr>
               <th>ID</th>
               <th>@lang('admin.level.table.col1')</th>
               <th>@lang('admin.level.table.col2')</th>
               <th>@lang('admin.level.table.col3')</th>
               <th>@lang('admin.level.table.col4')</th>
               <th>@lang('admin.level.table.col5')</th>
            </tr>
           
         </thead><br>
         <tbody>
            @forelse($scores as $score)
            <tr>
               <th>{{$score->id}}</th>
               <th>{{isset($score->user) ? $score->user->name : $score->name}}</th>
               <td>{{isset($score->config_bonus) ? $score->config_bonus->description : $score->description}}</td>
               <td>{{number_format($score->price,2, ',', '.')}}</td>
               <th>{{$score->order_id}}</th>
               <td>{{date('d/m/Y',strtotime($score->created_at))}}</td>
            </tr>
            @empty
            <p>@lang('admin.level.table.empty')</p>
            @endforelse
         </tbody>
      </table>
   </div>
   <div class="card-footer clearfix py-3 ">
      <nav aria-label="Page navigation example" class="">
         {{ "Page" . $scores->currentPage() . "  of  " . $scores->lastPage() }} @if ($scores->hasPages())
         <ul class="pagination mt-3">
            @if ($scores->onFirstPage())
            <li class="page-item disabled"><a class="page-link px-3">{{ __('Prev') }}</a></li>
            @else
            <li class="page-item"><a class="page-link" href="{{ $scores->previousPageUrl() }}">{{ __('Prev') }}</a></li>

            @endif

            <!-- 2 PAGINAS ANTES DA CURRENT -->
            <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
         <li class="page-item"><a class="page-link" href="#">3</a></li> -->

            <li class="page-item"><a class="page-link px-4" href="" aria-current="{{$scores->currentPage()}}">{{$scores->currentPage()}}</a></li>

            <!-- 2 PAGINAS DEPOIS DA CURRENT -->
            <!-- <li class="page-item"><a class="page-link" href="#">3</a></li>
         <li class="page-item"><a class="page-link" href="{{$scores->lastItem()}}">{{$scores->lastPage()}}</a></li> -->

            @if ($scores->hasMorePages())
            <li class="page-item"><a class="page-link px-3" href="{{ $scores->nextPageUrl()}}">{{ __('Next') }}</a></li>
            @else
            <li class="page-item disabled"><a class="page-link px-4">{{ __('Next') }}</a></li>
            @endif
         </ul>
         @endif
      </nav>
      {{--{{$scores->onEachSide(1)->links()}}
   </div> --}}
   <!-- <div class="card-footer clearfix py-3">
      {{$scores->appends([
         'search'=>request()->get('search',''),
         'fdate'=>request()->get('fdate',''),
         'sdate'=>request()->get('sdate',''),
      ])->links()}}
   </div> -->

   <!-- if (jobCount == '0') {
   $('.no-result').show();
   } else {
   $('.no-result').hide();
   }
   });
   });
   </script> -->
   @stop