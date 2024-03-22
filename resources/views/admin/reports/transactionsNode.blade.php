@extends('adminlte::page')

@section('title', 'Transactions')

@section('content_header')
  <div class="alignHeader">
    <h4>@lang('admin.transaction.title')</h4>
  </div>
  <i class="fa fa-home ml-3"></i> - @lang('admin.transaction.title2')
@stop

@section('content')

  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-sm-12 col-md-4">
          {{-- <form action="{{ route('admin.reports.searchTransactions') }}" method="GET">
            @csrf
            <div class="input-group input-group-lg">
              <input type="text" name="search" class="form-control @error('search') is-invalid @enderror"
                placeholder="@lang('admin.transaction.searchuser')">
              <span class="input-group-append">
                <button type="submit" class="btn btn-info btn-flat">@lang('admin.btn.search')</button>
              </span>
              @error('search')
                <span class="error invalid-feedback">{{ $message }}</span>
              @enderror
            </div>
          </form> --}}
        </div>
        <div class="col-12 col-md-8">
          {{-- <form class="row g-3" method="GET" action="{{ route('admin.reports.getDateTransactions') }}">
            @csrf
            <div class="col-auto">
              <label>@lang('admin.btn.firstdate'):</label>
            </div>
            <div class="col">
              <input type="date" class="form-control" name="fdate">
            </div>
            <div class="col-auto">
              <label>@lang('admin.btn.seconddate'):</label>
            </div>
            <div class="col">
              <input type="date" class="form-control" name="sdate">
            </div>
            <input type="submit" value="@lang('admin.btn.search')" class="btn btn-info">
          </form> --}}
        </div>
      </div>
    </div>
    <div class="card-body table-responsive">
      <span class="counter float-right"></span>
      <table class="table table-hover table-bordered results">
        <thead>
          <tr>
            <th>ID</th>
            <th>Type</th>
            <th>User</th>
            <th>Coin</th>
            <th>Status</th>
            <th>Price</th>
            <th>Price crypto</th>
            <th>Price crypto Paid</th>
            <th>Wallet</th>
            <th>Withdrawn</th>
            <th>Gas Withdrawn</th>
            <th>Payment of id</th>
            <th></th>
            {{-- <th>Change Withdrawn</th>
            <th>Link Hash</th>
            <th>Withdrawn Link Hash</th> --}}
          </tr>
          <tr class="warning no-result">
            <td colspan="4"><i class="fa fa-warning"></i>@lang('admin.btn.noresults')</td>
          </tr>
        </thead>
        <tbody>
          @forelse($transactions as $transaction)
            @if (strtolower($transaction->status) == 'paid')
              <tr class="table-success">
              @elseif(strtolower($transaction->status) == 'expired')
              <tr class="table-danger">
              @else
              <tr>
            @endif
            <th>{{ $transaction->id }}</th>
            <th>{{ $transaction->type == 1 ? 'Deposit' : 'Withdrawn' }}</th>
            <th>{{ $transaction->user }}</th>
            <th>{{ $transaction->coin }}</th>
            <th>{{ $transaction->status }}</th>
            <th>{{ $transaction->price }}</th>
            <th>{{ $transaction->price_crypto * 1 }}</th>
            <th>{{ $transaction->price_crypto_payed * 1 }}</th>
            <th>{{ $transaction->wallet }}</th>
            <th>{{ $transaction->withdrawn }}</th>
            <th>{{ $transaction->gas_fee }}</th>
            <th>{{ $transaction->payment_of_id }}</th>
            <th style="display: flex;flex-direction: row;gap:1rem">
              <button type="button" class="btn btn-primary">Change Withdrawn</button>
              <button type="button" class="btn btn-primary">Link Hash</button>
              <button type="button" class="btn btn-primary">Withdrawn Link Hash</button>
            </th>
            </tr>
          @empty
            <p class="m-4 fst-italic">@lang('admin.transaction.table.empty')</p>
          @endforelse
        </tbody>
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer clearfix py-3">
    {{ $transactions->appends([
            'search' => request()->get('search', ''),
            'fdate' => request()->get('fdate', ''),
            'sdate' => request()->get('sdate', ''),
        ])->links() }}
  </div>

@stop

@section('css')
  <link rel="stylesheet" href="{{ asset('/css/admin_custom.css') }}">
@stop
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
@section('js')
  <script>
    $(document).ready(function() {
      $(".search").keyup(function() {
        var searchTerm = $(".search").val();
        var listItem = $('.results tbody').children('tr');
        var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

        $.extend($.expr[':'], {
          'containsi': function(elem, i, match, array) {
            return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "")
              .toLowerCase()) >= 0;
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
