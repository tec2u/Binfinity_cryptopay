@extends('layouts.header')
@section('content')
    <main id="main" class="main">
        @include('flash::message')
        <section id="produtos" class="content">
            <div class="fade">
                <div class="container-fluid">
                    <h1>@lang('package.products')</h1>
                    <div class="container">
                        <div class="row">
                            @forelse($packages as $package)
                                <div class="col-sm-4 card-deck hover ">
                                    <div class="card ">
                                        @if ($package->id == 18)
                                        <img src="{{ asset('/images/bot1.jpg') }}" class="card-img-top" alt="...">
                                        @else
                                        <img src="{{ asset('/images/bot2.jpg') }}" class="card-img-top" alt="...">
                                        @endif
                                        <h5 class="card-title">{{ $package->name }}</h5>
                                        {{-- <h6 class="card-title">$ {{ $package->price }}</h6> --}}
                                        <h6 class="card-body">{!! $package->long_description !!}</h6>
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
                                        <div class="card-body">

                                            <a href="{{ route('packages.detail', ['id' => $package->id]) }}"
                                                class="btn btn-primary m-4 rounded-pill"> @lang('package.details')</a>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <p>@lang('package.any_products_registered')</p>
                            @endforelse

                        </div>
                        <div class="card-footer clearfix py-3">
                            {{ $packages->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
