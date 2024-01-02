@extends('layouts.header')
@section('content')
    <main id="main" class="main">
        <section id="payment" class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12">
                        <h1>Payment</h1>
                        <div class="card shadow my-3">
                            <h3 style="margin-left: 2%;" class="card-title">Value</h3>
                            <div class="card-header bbcolorp">
                                <div id="countdown" class="countdown text-center">
                                </div>
                            </div>
                            <div class="row p-3 mt-4 teste000">
                                <div class="w-75">
                                    <p class="text-black-25">
                                        After sending the USDT or BTC, please check the order page at HERE.
                                        It usually takes 1-5 minutes to approve the order.
                                        The value must be exactly the order value or your order will be submitted to be
                                        reviewed
                                    </p>
                                </div>
                                <div class="col-md-4 ">
                                    <div class="info-box mb-4 shadow">
                                        <div class="info-box-content">
                                            <span class="info-box-text">{{$paymentInfo['coin']}} : {{ $paymentInfo['value'] }}</span>
                                            <img style="width:100%"
                                                src='https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=usd:{{ $paymentInfo['address'] }}'></br>
                                                
                                                
                                        
                                                {{-- <img style="width:100%"
                                                src='https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=usd:{{ $paymentInfo['address'] }}?amount={{ $paymentInfo['USD'] }}'> --}}
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-md-4">
                                <div class="info-box mb-4 shadow">
                                    <div class="info-box-content">
                                        <span class="info-box-text">BTC: {{$paymentInfo['BTC']}}</span>
                            <img src='https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=btc:{{$paymentInfo['address']}}?amount={{$paymentInfo['BTC']}}'>
                        </div>
                    </div>
                </div> --}}

                                {{-- <div class="col-md-4">
                        <div class="info-box mb-4 shadow">
                            <div class="info-box-content">
                                <span class="info-box-text">EUR: {{$paymentInfo['EUR']}}</span>
                <img src='https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=eur:{{$paymentInfo['address']}}?amount={{$paymentInfo['EUR']}}' />
            </div>
        </div>
        </div> --}}

                                <div class="card-footer text-center p-4">
                                <h3 class="fw-bold">Wallet: </h3>
                                    <input type="text" class="form-control" id="AddressInput"
                                                    value="{{ $paymentInfo['address'] }}">
                                                <button class=" btn btn-dark orderbtn linkcopy px-4" type="button"
                                                    onclick="CopyAddress()">Copy Address</button>
                                    
                                </div>

                            </div>
                        </div>
        </section>
    </main>
    <script>
        //Função para copiar o address

        function CopyAddress() {

            var copyText = document.getElementById("AddressInput");


            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            navigator.clipboard.writeText(copyText.value);

           // alert("Copied the text: " + copyText.value);
            }
        (function() {

            //Redireciona o usuario depois de acabar os 30minutos para as ordens

            window.setTimeout(function(){

                 window.location.href = "/packages/packageslog";

            }, 1800000);

            

            //Inicio da função do contador
            
            var countdown, init_countdown, set_countdown;

            countdown = init_countdown = function() {
                countdown = new FlipClock($('.countdown'), {
                    clockFace: 'MinuteCounter',
                    language: 'en',
                    autoStart: false,
                    countdown: true,
                    showSeconds: true,
                    callbacks: {
                        start: function() {
                            return console.log('The clock has started!');
                        },
                        stop: function() {
                            return console.log('The clock has stopped!');
                        },
                        interval: function() {
                            var time;
                            time = this.factory.getTime().time;
                            if (time) {
                                return console.log('Clock interval', time);
                            }
                        }
                    }
                });
                return countdown;
            };

            set_countdown = function(minutes, start) {
                var elapsed, end, left_secs, now, seconds;
                if (countdown.running) {
                    return;
                }
                seconds = 30 * 60;
                now = new Date;
                start = new Date(start);
                end = start.getTime() + seconds * 1000;
                left_secs = Math.round((end - now.getTime()) / 1000);
                elapsed = false;
                if (left_secs < 0) {
                    left_secs *= -1;
                    elapsed = true;
                }
                countdown.setTime(left_secs);
                return countdown.start();
            };

            init_countdown();

            set_countdown(1, new Date());

        }).call(this);

        //# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiIiwic291cmNlUm9vdCI6IiIsInNvdXJjZXMiOlsiPGFub255bW91cz4iXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7QUFBQSxNQUFBLFNBQUEsRUFBQSxjQUFBLEVBQUE7O0VBQUEsU0FBQSxHQUFZLGNBQUEsR0FBaUIsUUFBQSxDQUFBLENBQUE7SUFDekIsU0FBQSxHQUFZLElBQUksU0FBSixDQUFjLENBQUEsQ0FBRSxZQUFGLENBQWQsRUFDWjtNQUFBLFNBQUEsRUFBVyxlQUFYO01BQ0EsUUFBQSxFQUFVLElBRFY7TUFFQSxTQUFBLEVBQVcsS0FGWDtNQUdBLFNBQUEsRUFBVyxJQUhYO01BSUEsV0FBQSxFQUFhLElBSmI7TUFLQSxTQUFBLEVBQ0U7UUFBQSxLQUFBLEVBQU8sUUFBQSxDQUFBLENBQUE7aUJBQ0wsT0FBTyxDQUFDLEdBQVIsQ0FBWSx3QkFBWjtRQURLLENBQVA7UUFFQSxJQUFBLEVBQU0sUUFBQSxDQUFBLENBQUE7aUJBQ0osT0FBTyxDQUFDLEdBQVIsQ0FBWSx3QkFBWjtRQURJLENBRk47UUFJQSxRQUFBLEVBQVUsUUFBQSxDQUFBLENBQUE7QUFDUixjQUFBO1VBQUEsSUFBQSxHQUFPLElBQUksQ0FBQyxPQUFPLENBQUMsT0FBYixDQUFBLENBQXNCLENBQUM7VUFDOUIsSUFBRyxJQUFIO21CQUNFLE9BQU8sQ0FBQyxHQUFSLENBQVksZ0JBQVosRUFBOEIsSUFBOUIsRUFERjs7UUFGUTtNQUpWO0lBTkYsQ0FEWTtBQWdCWixXQUFPO0VBakJrQjs7RUFvQjdCLGFBQUEsR0FBZ0IsUUFBQSxDQUFDLE9BQUQsRUFBVSxLQUFWLENBQUE7QUFFWixRQUFBLE9BQUEsRUFBQSxHQUFBLEVBQUEsU0FBQSxFQUFBLEdBQUEsRUFBQTtJQUFBLElBQUcsU0FBUyxDQUFDLE9BQWI7QUFDRSxhQURGOztJQUdBLE9BQUEsR0FBVSxPQUFBLEdBQVU7SUFFcEIsR0FBQSxHQUFNLElBQUk7SUFDVixLQUFBLEdBQVEsSUFBSSxJQUFKLENBQVMsS0FBVDtJQUNSLEdBQUEsR0FBTSxLQUFLLENBQUMsT0FBTixDQUFBLENBQUEsR0FBa0IsT0FBQSxHQUFVO0lBRWxDLFNBQUEsR0FBWSxJQUFJLENBQUMsS0FBTCxDQUFXLENBQUMsR0FBQSxHQUFNLEdBQUcsQ0FBQyxPQUFKLENBQUEsQ0FBUCxDQUFBLEdBQXdCLElBQW5DO0lBRVosT0FBQSxHQUFVO0lBQ1YsSUFBRyxTQUFBLEdBQVksQ0FBZjtNQUNFLFNBQUEsSUFBYSxDQUFDO01BQ2QsT0FBQSxHQUFVLEtBRlo7O0lBSUEsU0FBUyxDQUFDLE9BQVYsQ0FBa0IsU0FBbEI7V0FDQSxTQUFTLENBQUMsS0FBVixDQUFBO0VBbkJZOztFQXFCaEIsY0FBQSxDQUFBOztFQUNBLGFBQUEsQ0FBYyxDQUFkLEVBQWlCLElBQUksSUFBSixDQUFBLENBQWpCO0FBMUNBIiwic291cmNlc0NvbnRlbnQiOlsiY291bnRkb3duID0gaW5pdF9jb3VudGRvd24gPSAoKSAtPlxuICAgIGNvdW50ZG93biA9IG5ldyBGbGlwQ2xvY2sgJCgnLmNvdW50ZG93bicpLFxuICAgIGNsb2NrRmFjZTogJ01pbnV0ZUNvdW50ZXInLFxuICAgIGxhbmd1YWdlOiAnZW4nLFxuICAgIGF1dG9TdGFydDogZmFsc2UsXG4gICAgY291bnRkb3duOiB0cnVlLFxuICAgIHNob3dTZWNvbmRzOiB0cnVlXG4gICAgY2FsbGJhY2tzOlxuICAgICAgc3RhcnQ6ICgpIC0+XG4gICAgICAgIGNvbnNvbGUubG9nICdUaGUgY2xvY2sgaGFzIHN0YXJ0ZWQhJ1xuICAgICAgc3RvcDogKCkgLT5cbiAgICAgICAgY29uc29sZS5sb2cgJ1RoZSBjbG9jayBoYXMgc3RvcHBlZCEnXG4gICAgICBpbnRlcnZhbDogKCkgLT5cbiAgICAgICAgdGltZSA9IHRoaXMuZmFjdG9yeS5nZXRUaW1lKCkudGltZVxuICAgICAgICBpZiB0aW1lIFxuICAgICAgICAgIGNvbnNvbGUubG9nICdDbG9jayBpbnRlcnZhbCcsIHRpbWVcblxuICAgIHJldHVybiBjb3VudGRvd25cbiAgXG5cbnNldF9jb3VudGRvd24gPSAobWludXRlcywgc3RhcnQpIC0+XG5cbiAgICBpZiBjb3VudGRvd24ucnVubmluZ1xuICAgICAgcmV0dXJuXG5cbiAgICBzZWNvbmRzID0gbWludXRlcyAqIDYwXG5cbiAgICBub3cgPSBuZXcgRGF0ZVxuICAgIHN0YXJ0ID0gbmV3IERhdGUgc3RhcnRcbiAgICBlbmQgPSBzdGFydC5nZXRUaW1lKCkgKyBzZWNvbmRzICogMTAwMFxuXG4gICAgbGVmdF9zZWNzID0gTWF0aC5yb3VuZCAoZW5kIC0gbm93LmdldFRpbWUoKSkgLyAxMDAwXG5cbiAgICBlbGFwc2VkID0gZmFsc2VcbiAgICBpZiBsZWZ0X3NlY3MgPCAwXG4gICAgICBsZWZ0X3NlY3MgKj0gLTFcbiAgICAgIGVsYXBzZWQgPSB0cnVlXG5cbiAgICBjb3VudGRvd24uc2V0VGltZShsZWZ0X3NlY3MpXG4gICAgY291bnRkb3duLnN0YXJ0KClcbiAgICBcbmluaXRfY291bnRkb3duKClcbnNldF9jb3VudGRvd24oMSwgbmV3IERhdGUoKSlcbiJdfQ==
        //# sourceURL=coffeescript
    </script>
@endsection
