@extends('adminlte::page')

@section('title', 'Withdraw Requests')

@section('content_header')
<h4>@lang('admin.withdrawrequest.title')</h4>
@stop

@section('content')
@include('flash::message')
<div class="card">
   <div class="card-header">
      <div class="alignPackage">
         <h3>@lang('admin.withdrawrequest.title')</h3>
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
               <th>@lang('admin.withdrawrequest.request.col1')</th>
               <th>@lang('admin.withdrawrequest.request.col2')</th>
               <th>@lang('admin.withdrawrequest.request.col3')</th>
               <th>@lang('admin.withdrawrequest.request.col4')</th>
               <th>@lang('admin.withdrawrequest.request.col5')</th>
            </tr>
            <tr class="warning no-result">
               <td colspan="4"><i class="fa fa-warning"></i> @lang('admin.btn.noresults')</td>
            </tr>
         </thead>
         <tbody>
            @forelse($withdraws as $withdraw)
            <tr>
               <th>{{$withdraw->id}}</th>
               <td>{{$withdraw->user->name}}</td>
               <td>{{$withdraw->value}}</td>
               <td>{{$withdraw->created_at}}</td>
               <td>
                  @if($withdraw->status == 2)
                  <button class="btn btn-success btn-sm m-0">CANCELED</button>
                  @elseif($withdraw->status == 0)
                  <button class="btn btn-warning btn-sm m-0">PENDING</button>
                  @else
                  <button class="btn btn-primary btn-sm m-0">PAID</button>
                  @endif
               </td>
               <td>
                 <!-- <button type="button" class="btn btn-warning btn-sm m-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Auto
                  </button><br>-->
                  
                  <button type="button" class="btn btn-primary btn-sm m-0" data-bs-toggle="modal" data-bs-target="#changeModal">
                     @lang('admin.withdrawrequest.request.status')
                  </button>
               </td>
            </tr>
            @empty
            <p>@lang('admin.withdrawrequest.request.empty')</p>
            @endforelse
         </tbody>
      </table>
   </div>
</div>
<!-- Modal -->
@forelse($withdraws as $withdraw)
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">@lang('admin.withdrawrequest.status.title')</h5>
            <button id='closeModal' type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('admin.btn.close')</button>
         </div>
         <div class="modal-body">
            <form class="row g-3">
               <table class="table table-hover table-bordered responsive col-md-6">
                  <thead>
                     <tr>
                        <th scope="col"><b>@lang('admin.withdrawrequest.status.col1')</th>
                        <th scope="col"><b>@lang('admin.withdrawrequest.status.col2')</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <th><b>@lang('admin.withdrawrequest.status.col3'):</th>
                        <td>WD4802913412</td>
                     </tr>
                     <tr>
                        <th><b>@lang('admin.withdrawrequest.status.col4'):</th>
                        <td>{{$withdraw->user->name}}</td>
                     </tr>
                     <tr>
                        <th><b>@lang('admin.withdrawrequest.status.col5'):</th>
                        <td>{{$withdraw->user->name}}</td>
                     </tr>
                     <tr>
                        <th><b>@lang('admin.withdrawrequest.status.col6')</th>
                        <td>{{$withdraw->value}} BUSD</td>
                     </tr>
                     <tr>
                        <th><b>@lang('admin.withdrawrequest.status.col7')</th>
                        <td><b>wallet</td>
                     </tr>
                     <tr>
                        <th><b>@lang('admin.withdrawrequest.status.col8')</th>
                        <td>5-7 Days</td>
                     </tr>
                     <tr>
                        <th><b>@lang('admin.withdrawrequest.status.col9')</th>
                        <td>{{date("h:i:s A , l jS \of F Y ")}}</td>
                     </tr>
                  </tbody>
               </table>
               <div class="col-md-6">
                  <h4>@lang('admin.withdrawrequest.status.message')</h4>
                  <hr class="dropdown-divider">
                  <textarea type="text" class="form-control" rows="8"></textarea>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('admin.btn.close')</button>
            @if($withdraw->type == "Withdraw Comission")
            <button type="button" class="btn btn-primary" onclick="location.href = '{{ route('admin.payWithdraw', $withdraw->id) }}'">@lang('admin.btn.processed')</button>
            @elseif($withdraw->type == "Withdraw CC")
            <button type="button" class="btn btn-primary" onclick="location.href = '{{ route('admin.payWithdrawCC', $withdraw->id) }}'">@lang('admin.btn.processed')</button>
            @else
            <button class="btn btn-danger btn-sm m-0">@lang('admin.withdrawrequest.status.wrong')</button>
            @endif
         </div>
      </div>
   </div>
</div>
@empty

@endforelse

@forelse($withdraws as $withdraw)
<div class="modal fade" id="changeModal" tabindex="-1" aria-labelledby="changeModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="changeModalLabel">@lang('admin.withdrawrequest.status.title')</h5>
            <button id='closeModal' type="button" class="btn btn-danger" data-bs-dismiss="modal">@lang('admin.btn.close')</button>
         </div>
         <div class="modal-body">
            <form class="row g-3" action="{{route('admin.withdraw.update', ['id' => $withdraw->id])}}" method="POST">
               @csrf
               @method('PUT')
               <table class="table table-hover table-bordered responsive col-md-6">
                  <thead>
                     <tr>
                        <th scope="col"><b>@lang('admin.withdrawrequest.status.col1')</th>
                        <th scope="col"><b>@lang('admin.withdrawrequest.status.col2')</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <th><b>@lang('admin.withdrawrequest.status.col3'):</th>
                        <td>WD{{$withdraw->id}}</td>
                     </tr>
                     <tr>
                        <th><b>wallet</th>
                        <td>
                        @php   

                        $wallet_qr = Illuminate\Support\Facades\DB::select("SELECT wallet FROM wallets where user_id=$withdraw->user_id order by id desc limit 1;");
                        $wallet = $wallet_qr[0]->{'wallet'};
                        if(isset($wallet)){echo $wallet;} 

                        @endphp

                        </td>
                     </tr>
                     <tr>
                        <th><b>@lang('admin.withdrawrequest.status.col5'):</th>
                        <td>{{$withdraw->user->name}}</td>
                     </tr>
                     <tr>
                        <th><b>@lang('admin.withdrawrequest.status.col6')</th>
                        <td>{{$withdraw->value}} BUSD</td>
                     </tr>
                     <tr>
                        <th><b>@lang('admin.withdrawrequest.status.col7')</th>
                        <td><b>wallet</td>
                     </tr>
                     <tr>
                        <th><b>@lang('admin.withdrawrequest.status.col8')</th>
                        <td>5-7 Days</td>
                     </tr>
                     <tr>
                        <th><b>@lang('admin.withdrawrequest.status.col9')</th>
                        <td>{{date("h:i:s A , l jS \of F Y ")}}</td>
                     </tr>
                  </tbody>
               </table>
               <div class="col-md-6">
                  <h4>@lang('admin.withdrawrequest.status.message')</h4>
                  <hr class="dropdown-divider">
                  <textarea id="message" name="message" type="text" class="form-control" rows="8">@if(isset($withdraw->message))   
                  {{$withdraw->message}}
                  @endif</textarea>

                  <label for="status">@lang('admin.withdrawrequest.status.status')</label>
                  <select id="status" name="status" class="form-control">
                     <option value="1">pay</option>
                     
                     <option value="2">cancel</option>
                  </select>

                  <button type="submit" class="btn btn-primary mt-3">process payment</button>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('admin.btn.close')</button>
         </div>
      </div>
   </div>
</div>
@empty

@endforelse

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