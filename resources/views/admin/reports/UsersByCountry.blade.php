@extends('adminlte::page')

@section('title', 'Registrations Report')

@section('content_header')
<div class="alignHeader">
   <h4>Registrations Report</h4>
</div>
<i class="fa fa-home ml-3"></i>  @lang('admin.level.subtitle')
@stop

@section('content')

<div class="card">
   <div class="card-header">
      <div class="alignPackage">
      <h3>Registrations by Country Report</h3>
      <h5>Registrations by Country</h5>
      </div>
   </div>
   <div class="card-body table-responsive">
      <div class="row">
         <div class="col-sm-12 col-md-4">
           <!-- <form action="{{route('admin.UsernameUpToMaster.searchUserToMaster')}}" method="POST">
               @csrf
               <div class="input-group input-group-lg">
                  <input type="text" name="search" class="form-control @error('search') is-invalid @enderror" placeholder="@lang('admin.btn.search')">
                  </br>
                  
                  <span class="input-group-append">
                     <button type="submit" class="btn btn-info btn-flat">@lang('admin.btn.search')</button>
                  </span>
                  </br>
                 
                  </br>
                  @error('search')
                  <span class="error invalid-feedback">{{$message}}</span>
                  @enderror
               </div>
            </form>-->
         </div>
         <canvas id="myChart" height="100px"></canvas><br> <br> <br>
      <table class="table table-hover table-bordered results">
         <thead>
            <tr>
            <th>country</th>
            <th>Total Registered</th>
           
         
    
       
            </tr>
           
         </thead>
        
         
         
         <tbody>

            
            
            @forelse($data as $r)
            
           
            <tr>
            <th><img src="{{$r["flag"]}}" style="width:50px">{{$r["country"]}}</th>
            <th>{{$r["amount"]}}</th>
            
      
            
 
            </tr>
            @empty
            <p>@lang('admin.level.table.empty')</p>
            @endforelse
         </tbody>
      </table>
   </div>
   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
<script type="text/javascript">
  
        var labels =  {{ Js::from($labelsChart) }};
      var users =  {{ Js::from($dataChart) }};

      const data = {
        labels: labels,
        datasets: [{
          label: 'Users Registration Progression',
          backgroundColor: 'rgb(67, 156, 53)',
          borderColor: 'rgb(67, 156, 53)',
          data: users,
        }]
      };
  
      const config = {
        type: 'line',
        data: data,
        options: {}
      };
  
      const myChart = new Chart(
        document.getElementById('myChart'),
        config
      );
  
</script>
      @stop