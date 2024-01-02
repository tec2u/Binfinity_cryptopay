@extends('adminlte::page')

@section('title', 'Payouts Of The Day')

@section('content_header')
<div class="alignHeader">
    <h4>Payouts Of The Day</h4>
</div>
<i class="fa fa-home ml-3"></i> @lang('admin.level.subtitle')
@stop

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            @include('admin.reports.flash-message')
            <h1>Payouts Of The Day</h1>
            <div class="card shadow my-3">
                <div class="card-header bbcolorp">
                    <h3 class="card-title">Payouts Of The Day</h3>
                </div>
                <div class="card-header py-3">
                    <a href="{{route('admin.order-bonus.export')}}" type="button" class="btn btn-info btn-md">Export Excel</a>

                    <div class="card-tools">
                        <div class="input-group input-group-sm my-1" style="width: 250px;">
                            <input type="text" name="table_search" class="form-control float-right rounded-pill pl-3" placeholder="@lang('withdraw.search')">
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
                            <tr>
                                <th>Id</th>
                                <th>
                                    Bonus
                                </th>
                                <th>@lang('reports.referral_commission.date')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bancos as $banco)
                            <tr>
                                <th>{{$banco->id}}</th>
                                <td> {{number_format($banco->amount_paid,2, ',', '.')}}</td>
                                <td>{{date('d/m/Y',strtotime($banco->created_at))}}</td>
                            </tr>
                            @empty
                            <td colspan="5">
                                <p class="m-4 fst-italic text-center">
                                    {{-- @lang('reports.referral_commission.empyt') --}}
                                    You don't have any Bonus Daily registered!
                                </p>
                            </td>
                            @endforelse

                        </tbody>
                    </table>


                    <div class="card-footer clearfix py-3">
                        {{$bancos->links()}}
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@stop
