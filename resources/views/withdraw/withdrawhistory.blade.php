@extends('layouts.header')
@section('content')
  <main id="main" class="main">
    <section id="withdrawhistory" class="content">
      <div class="fade">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <h1 class="up font">@lang('withdraw.withdraw_history')</h1>
              <div class="card shadow my-3">
                <div class="card-header bbcolorp">
                  <h3 class="card-title up font">@lang('withdraw.withdraw_history')</h3>
                </div>
                <div class="card-header py-3">
                  <!-- <button type="button" class="btn btn-info btn-sm rounded-pill" style="width: 80px;">CSV</button>
                              <button type="button" class="btn btn-success btn-sm rounded-pill" style="width: 80px;">Excel</button>
                              <button type="button" class="btn btn-danger btn-sm rounded-pill" style="width: 80px;">PDF</button> -->
                  <div class="card-tools">
                    <div class="input-group input-group-sm my-1" style="width: 250px;">
                      <input type="text" name="table_search" class="form-control float-right rounded-pill pl-3"
                        placeholder="@lang('withdraw.search')">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="bi bi-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr class="font up">
                        <th>@lang('withdraw.id')</th>
                        <th>@lang('withdraw.value')</th>
                        <th>@lang('withdraw.processing_time')</th>
                        <th>@lang('withdraw.status')</th>

                        <th>LINK</th>
                        <th>@lang('withdraw.date')</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($withdraws as $withdraw)
                        <tr>
                          <td>{{ $withdraw->id }}</td>
                          <td>$ {{ number_format($withdraw->value, 2, ',', '.') }}</td>
                          <td>5-7 @lang('withdraw.days')</td>
                          @if ($withdraw->status == 1)
                            <td class="approvd">@lang('withdraw.approved')</td>
                          @else
                            <td class="text-warning">@lang('withdraw.awaiting_payment')</td>
                          @endif
                          @if (isset($withdraw->message))
                            <td class="text-warning">{{ $withdraw->message }}</td>
                          @else
                            <td></td>
                          @endif
                          <td>{{ date('H:i d/m/Y ', strtotime($withdraw->created_at)) }}</td>
                        </tr>
                      @empty
                        <p class="m-4 fst-italic">@lang('withdraw.any_withdraw_registered')</p>
                      @endforelse

                    </tbody>
                  </table>
                </div>
                <div class="card-footer clearfix py-3">
                  <ul class="pagination pagination-sm m-0 float-right">
                    {{ $withdraws->links() }}
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
