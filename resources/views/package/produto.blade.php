@extends('layouts.header')
@section('content')
    <main id="main" class="main">
        @include('flash::message')
        <section id="produto" class="content">
            <div class="fade">
                <div class="container-fluid">
                    <div class="row justify-content-evenly">
                        <div class="card shadow " style="width: 28rem;">
                            <img src="{{ asset('storage/' . $package->img) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h1 class="card-title" style='display: contents;
    font-size: 16px;'>INVOICE</h3>
                            </div>
                            {!! $package->long_description !!}
                            {{-- <div class="d-flex shadow-sm cardlist">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item pk">@lang('package.product_price')</li>
                                    <li class="list-group-item pk">@lang('package.daily_return')</li>
                                    <li class="list-group-item pk">@lang('package.yearly_return_coin')</li>
                                    <li class="list-group-item pk">@lang('package.total_return_coin')</li>
                                    <li class="list-group-item pk">@lang('package.steaking_period')</li>
                                    <li class="list-group-item pk">@lang('package.capping_coin')</li>
                                    <li class="list-group-item pk">@lang('package.expected_total_return')</li>
                                </ul>
                                <ul class="list-group list-group-flush text-end">
                                    <li class="list-group-item pk"> $ {{$package->price}}</li>
                                    <li class="list-group-item pk">{{$package->daily_returns}}</li>
                                    <li class="list-group-item pk">{{$package->yaerly_returns}}</li>
                                    <li class="list-group-item pk">{{$package->total_returns}}</li>
                                    <li class="list-group-item pk">{{$package->period_days}} @lang('package.months')</li>
                                    <li class="list-group-item pk">{{$package->capping_coin}}</li>
                                    <li class="list-group-item pk">{{number_format($package->packageTotal($package->id),2, ',', '.')}} / @lang('package.month')</li>
                                </ul>
                            </div> --}}

                            <h6 class="card-title">
                                <label for="value_invest">ENTER THE AMOUNT IN USD</label>
                            </h6>
                            <input type="number" class="form-control" name="value_invest" id="value_invest"
                                min="{{ $package->price }}" step="0.01" value="{{ $package->price }}">

                            <div class="card-body">
                                @if ($package->plan_id == null)
                                
                                    <a onclick="invest()" class="btn btn-primary rounded-pill m-4">
                                    CREATE INVOICE
                                    </a>
                                   
                                    <script>

                                        function invest() {
                                            var route = "{!! route('payment.paymentBTC', ['package' => $package->id, 'value' => 'value_invest']) !!}";
                                            var value_invest = document.querySelector('#value_invest').value;
                                            var new_route = route.replace('value_invest', value_invest);
                                            location.href = new_route;
                                        }

                                        
                                    </script>
                                @else
                                    <a onclick="confirmPlan()" class="btn btn-primary rounded-pill m-4">@lang('purchase.wallet.li6')</a>
                                    <script>
                                        function confirmPlan() {
                                            if (confirm("You just selected the {!! $package->name !!} plan, is that correct?")) {
                                                location.href = "{!! route('payment.subscriptionClub', ['package' => $package->id]) !!}";
                                            } else {
                                                alert("Please go back and choose the correct plan!");
                                                history.go(-1);
                                            }
                                        }
                                    </script>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
