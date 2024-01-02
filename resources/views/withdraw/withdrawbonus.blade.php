@extends('layouts.header')
@section('content')

<main id="main" class="main">
    @include('flash::message')
    <section id="withdrawrequest" class="content">
        <div class="fade">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h1>@lang('withdraw.withdraw_bonus')</h1>
                        <div class="card shadow my-3">
                            <div class="card-header bbcolorp">
                                <h3 class="card-title">@lang('withdraw.withdraw_bonus')</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm pt-3" style="width: 250px;">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary btn-sm rounded-pill " style="width: 220px;" data-bs-toggle="modal" data-bs-target="#withdrawrequestModal">
                                                <i class="bi bi-plus-lg"></i>
                                                @lang('withdraw.new_request')
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header py-3">
                                <!-- <button type="button" class="btn btn-info btn-sm rounded-pill" style="width: 80px;">CSV</button>
                            <button type="button" class="btn btn-success btn-sm rounded-pill" style="width: 80px;">Excel</button>
                            <button type="button" class="btn btn-danger btn-sm rounded-pill" style="width: 80px;">PDF</button> -->
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
                                            <th>@lang('withdraw.id')</th>
                                            <th>@lang('withdraw.value')</th>
                                            <th>@lang('withdraw.processing_time')</th>
                                            <th>@lang('withdraw.status')</th>
                                            <th>@lang('withdraw.date')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($withdraws as $withdraw)
                                        <tr>
                                            <td>{{$withdraw->id}}</td>
                                            <td>$ {{number_format($withdraw->value, 2, ',', '.')}}</td>
                                            <td>5-7 @lang('withdraw.days')</td>
                                            @if ($withdraw->status == 1)
                                            <td class="approvd">@lang('withdraw.approved')</td>
                                            @else
                                            <td class="text-warning">@lang('withdraw.awaiting_payment')</td>
                                            @endif

                                            <td>{{date('H:i d/m/Y ', strtotime($withdraw->created_at))}}</td>
                                        </tr>
                                        @empty
                                        <p class="m-4 fst-italic">@lang('withdraw.any_withdraw_registered')</p>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix py-3">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    {{$withdraws->links()}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="withdrawrequestModal" tabindex="-1" aria-labelledby="withdrawrequestLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="withdrawrequestLabel">@lang('withdraw.withdraw_amount')</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="@lang('withdraw.close')"></button>
                    </div>
                    <div class="modal-body my-3">
                        <div class="amount">@lang('withdraw.current_balance'): <b> {{number_format($user->getTotalBancoIndicacao() + + $user->getTotalBancoILevel(), 2, ',', '.')}}</b></div>
                        <form action="{{route('withdraws.bonus')}}" method="POST">
                            @csrf
                            <div class="my-5">
                                <label for=" recipient-name" class="col-form-label">@lang('withdraw.amount'):</label>
                                <div class="input-group ">
                                    <input type="number" name="value" id="value" class="form-control" aria-label="@lang('withdraw.amount_bonus')" id="recipient-name" min="50" max="10000" placeholder="@lang('withdraw.enter_amount')">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                            <div class="note">
                                <h5>@lang('withdraw.note')</h5>
                                <p>@lang('withdraw.minimum_withdraw_amount')</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary rounded-pill">@lang('withdraw.submit')</button>
                                <button type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal">@lang('withdraw.close')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
</main>

<script>
    $(window).load(function() {
        $('#flash-overlay-modal').modal('show');
    });

    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
@endsection