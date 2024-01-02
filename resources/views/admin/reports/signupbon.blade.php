@extends('adminlte::page')

@section('title', 'Order Bonus')

@section('content_header')
    <div class="alignHeader">
        <h4>Order Bonus</h4>
    </div>
    <i class="fa fa-home ml-3"></i> @lang('admin.level.subtitle')
@stop

@section('content')

    <div class="container-fluid">
        @include('admin.reports.flash-message')
        <div class="row">
            <div class="col-12">
                <h1>Order Bonus</h1>
                <div class="card shadow my-3">
                    <div class="card-header bbcolorp">
                        <h3 class="card-title">Order Bonus</h3>
                        <p class="text-right">
                            <b>Total : </b> {{ $count_pay }}
                            <b>Total Payment: </b> {{ number_format($count_pay_orders ?? 0, 2, ',', '.') }}
                        </p>
                    </div>
                    <div class="card-header py-3">
                        @if ($count_pay > 0)
                            <a href="{{ route('admin.order-bonus.list.pay') }}" type="button"
                                class="btn btn-info btn-md">Start</a>

                            <a href="#" data-target="#my-modal" data-toggle="modal" type="button"
                                class="btn btn-primary btn-md">Start Bonus Per Data</a>
                        @endif

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
                                <tr>
                                    <th>Id</th>
                                    <th>
                                        Bonus
                                        {{-- @lang('reports.referral_commission.price') --}}
                                    </th>
                                    <th>@lang('reports.referral_commission.from')</th>
                                    <th>@lang('reports.referral_commission.id_order')</th>
                                    <th>@lang('reports.referral_commission.date')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bancos as $banco)
                                    <tr>
                                        <th>{{ $banco->id }}</th>
                                        <td> {{ number_format($banco->price * ($value_perc / 100), 2, ',', '.') }}</td>
                                        @if (isset($banco->name_user))
                                            <td> {{ $banco->name_user }}</td>
                                        @else
                                            <td>{{ $banco->getUserOrder($banco->order_id) }}</td>
                                        @endif
                                        <td>{{ $banco->order_id }}</td>
                                        <td>{{ date('d/m/Y', strtotime($banco->created_at)) }}</td>
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

                        @if (isset($banco->name_user))
                            <div class="card-header bbcolorp">
                                <h3 class="card-title">
                                    <a href="{{ route('admin.order-bonus.store', ['value_perc' => $value_perc, 'date' => $_GET['date_save'] ?? null, 'amount_paid' => $count_pay_orders ?? 0]) }}"
                                        type="button" class="btn btn-success btn-md">Start Bonus Daily</a>
                                </h3>
                                <p class="text-right">
                                    <b>Total Users Bonus Daily : </b> {{ $count_pay }}
                                    <b>Total Payment: </b> {{ number_format($count_pay_orders ?? 0, 2, ',', '.') }}
                                </p>
                            </div>
                        @endif
                        <div class="card-footer clearfix py-3">
                            {{ $bancos->links() }}
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">
                        @lang('admin.unilevel.titlecreate2')
                    </h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.order-bonus.list.pay') }}" method="get" enctype="multipart/form-data">
                        <div class="card-body">
                            {{-- @csrf --}}
                            <div class="form-group">
                                <label for="level">
                                    Value Percentage
                                    {{-- @lang('admin.unilevel.table.col1') --}}
                                </label>
                                <input type="number"
                                    class="form-control form-control-lg
                             @error('value_perc') is-invalid @enderror"
                                    id="value_perc" name="value_perc" placeholder="1 ~ 100" value="{{ old('level') ?? 1 }}"
                                    required max="100" min="1">
                                @error('value_perc')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status">
                                    Date
                                    {{-- @lang('admin.unilevel.table.col1') --}}
                                </label>

                                <select class="form-control form-control-lg @error('date_save') is-invalid @enderror"
                                    id="status" name="date_save">
                                    <option value="">Selecione a Data</option>
                                    @foreach ($dates_save as $item)
                                        <option value="{{ $item->date_save }}">
                                            {{ date('d-m-Y', strtotime($item->date_save)) }}</option>
                                    @endforeach
                                </select>


                                @error('status')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn brn-lager btn-success btn-block">
                                {{-- @lang('admin.unilevel.register') --}}
                                Start
                            </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
