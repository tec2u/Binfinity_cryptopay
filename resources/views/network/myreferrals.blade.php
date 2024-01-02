@extends('layouts.header')
@section('content')

<main id="main" class="main">
    <section id="myreferrals" class="content">
        <div class="fade">
            <div class="container-fluid">
                <div class="row">
                    <h1 class="mb-3">@lang('network.my_referrals')</h1>
                    @forelse($networks as $network)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class=" card card-widget widget-user-2 shadow">
                            <div class="widget-user-header bbcolorp">
                                <div class="widget-user-image">
                                    @if (!empty($network->user->image_path))
                                        <img class="img-circle elevation-2 mx-2" src="{{asset('storage/'.$network->user->image_path)}}" alt="@lang('network.user_avatars')" class="rounded-circle">
                                    @else
                                        <img class="img-circle elevation-2 mx-2" src="../../../images/photo_2023-10-16_11-20-53.jpg" alt="@lang('network.user_avatars')" class="rounded-circle">
                                    @endif
                                </div>
                                <h3 class="widget-user-username px-3">
                                    @php
                                    if(isset($network->user->login)){ echo $network->user->login; }
                                    @endphp </h3>
                                <h3 class="widget-user-username px-3" style="font-size: 15px; ">@php
                                    if(isset($network->user->email)){ echo $network->user->email; }
                                    @endphp</h3>
                            </div>
                            <div class="card-footer p-0">
                                <ul class="nav flex-column">
                                <li class="nav-item p-4">
                                        <h6>
                                            @lang('network.total_investment') <span class="float-right">-</span>
                                        </h6>
                                    </li>
                                    <li class="nav-item p-4">
                                        <span>
                                            <h6>
                                                @lang('network.status')
                                            -

                                            </h6>
                                    </li>
                                    <li class="nav-item p-4">
                                        <h6>
                                           Weekly Payment
                                           
                                        </h6>
                                    </li>
                                    <li class="nav-item p-4">
                                        <h6>
                                           Total Profit <span class="float-right">0</span>
                                        </h6>
                                    </li>
                                    <li class="nav-item p-4">
                                        <span>
                                            <h6>
                                            Total Comission <span class="float-right">0</span>
                                            </h6>
                                    </li>
                                    <li class="nav-item p-4">
                                        <h6>
                                        Weekly Profit <span class="float-right">0</span>
                                        </h6>
                                    </li>
                                    <li class="nav-item p-4">
                                        <span>
                                            <h6>
                                            Weekly Commission <span class="float-right">0</span>

                                            </h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p>@lang('network.any_referrals_registered')</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
