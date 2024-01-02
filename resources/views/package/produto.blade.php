@extends('layouts.header')
@section('content')
    <main id="main" class="main">
        @include('flash::message')
        <section id="produto" class="content">
            <div class="fade">
                <div class="container-fluid">
                    <div class="row justify-content-evenly">
                        <div class="card shadow " style="width: 28rem;">
                            @if ($package->id == 18)
                            <img src="{{ asset('/images/bot1.jpg') }}" class="card-img-top" alt="...">
                            @else
                            <img src="{{ asset('/images/bot2.jpg') }}" class="card-img-top" alt="...">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $package->name }}</h5>
                            </div>
                            {!! $package->long_description !!}







                            <div class="card-body">
                                @if ($package->plan_id == null)

                                    <a onclick="confirmPlan()" class="btn btn-primary rounded-pill m-4">Subscribe Now</a>
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
