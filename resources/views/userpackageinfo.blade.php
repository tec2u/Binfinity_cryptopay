@extends('layouts.header')
@section('content')

  <main id="main" class="main">
    @include('flash::message')
    <section id="userpackageinfo" class="content">
      <div class="fade">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <h1 class="up font">MY ACCOUNTS</h1>
              <div class="card shadow my-3">
                <div class="card-header bbcolorp">
                  <h3 class="card-title up font">@lang('package.info')</h3>
                </div>
                <div class="card-header py-3">
                  <!-- <button type="button" class="btn btn-info btn-sm rounded-pill" style="width: 80px;">CSV</button>
                                  <button type="button" class="btn btn-success btn-sm rounded-pill" style="width: 80px;">Excel</button>
                                  <button type="button" class="btn btn-danger btn-sm rounded-pill" style="width: 80px;">PDF</button> -->
                  <div class="card-tools">
                    <div class="input-group input-group-sm my-1" style="width: 250px;">
                      <input type="text" name="table_search" class="form-control float-right rounded-pill pl-3"
                        placeholder="@lang('package.search')">
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
                      <tr class="up font">
                        <th>NAME</th>
                        <th>ACCOUNT ID</th>
                        <th>ACCOUNT TYPE</th>

                        <th>DATE</th>
                        <th>ACCOUNT STATUS</th>
                        <th>DELETE</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($orderpackages as $orderpackage)
                        <tr>
                          <th>{{ $orderpackage->package->name }}</th>
                          <td>{{ $orderpackage->id }}</td>
                          <td>$ {{ $orderpackage->price }}</td>
                          {{-- <td>{{$orderpackage->package->daily_returns}}</td>
                                            <td>{{$orderpackage->package->yaerly_returns}}</td>
                                            <td>{{$orderpackage->package->total_returns}}</td>
                                            <td>{{$orderpackage->package->period_days}} @lang('package.months')</td>
                                            <td>{{$orderpackage->package->capping_coin}}</td>
                                            <td>{{number_format($orderpackage->package->packageTotal($orderpackage->package->id),2, ',', '.')}} </td> --}}
                          <td>{{ date('d/m/Y', strtotime($orderpackage->created_at)) }}</td>
                          <td>
                            @if ($orderpackage->payment_status == 1)
                              <span class="rounded-pill bg-success px-4 py-1">ACTIVATED</span>
                            @elseif($orderpackage->payment_status == 2)
                              <span class="rounded-pill bg-warning px-4 py-1">@lang('package.cancelled')</button>
                              @else
                                @if ($orderpackage->user == '' and $orderpackage->pass == '')
                                  <span class="rounded-pill bg-warning px-4 py-1">
                                    <a href="{{ route('packages.packageuserpass', ['id' => $orderpackage->id]) }}">
                                      ADD USERNAME / PASSWORD</a></span>
                                @else
                                  <span class="rounded-pill bg-primary px-4 py-1">ANALYZING</span>
                                @endif
                            @endif
                          </td>
                          <td>
                            @if ($orderpackage->payment_status != 1)
                              <button class="btn rounded-pill bg-info px-4 py-1"><a
                                  href="{{ route('packages.hide', ['id' => $orderpackage->id]) }}">@lang('package.btn_hide')</a></button>
                            @else
                              <button class="btn rounded-pill bg-info px-4 py-1" disabled><a
                                  href="{{ route('packages.hide', ['id' => $orderpackage->id]) }}">@lang('package.btn_hide')</a></button>
                            @endif
                          </td>
                        </tr>
                      @empty
                        <p>@lang('package.any_packages_registered')</p>
                      @endforelse
                    </tbody>
                  </table>
                </div>
                <div class="card-footer clearfix py-3">
                  {{ $orderpackages->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
