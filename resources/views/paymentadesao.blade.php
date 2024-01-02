@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html {
        font-size: 16px;
    }

    body {
        font-family: 'Poppins', sans-serif;
        padding: 3rem;
    }

    .card {
        width: 100%;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        display: flex;
        border-radius: 10px;
        border-color: #777;
        border-width: 5px;
        font-family: 'Poppins', sans-serif;
    }


    .card__content {
        flex-basis: auto;
        padding: 0%;
    }

    .card__title {
        display: block;
        text-align: center;
        color: #adadad;
        background-color: black;
        padding: 2%;
        border-top-right-radius: 4px;
        border-top-left-radius: 4px;
        margin-bottom: 0px !important;
        font-family: 'Poppins', sans-serif;
    }

    .card__desc {
        font-size: 0.95rem;
        line-height: 1.8;
        color: black;
        margin-bottom: 3.125rem;
        padding: 0 2rem;
        margin-top: 20px;
        font-family: 'Poppins', sans-serif;
    }

    .card__desc2 {
        float: right;
        font-size: 0.95rem;
        line-height: 1.8;
        color: #777;
        margin-bottom: 3.125rem;
    }

    .card__price {
        font-size: 2.05rem;
        font-weight: 800;
        color: #000;
        margin-bottom: 1.4rem;
        padding: 2rem;
        font-family: 'Poppins', sans-serif;
    }

    .card__button {
        display: inline-block;
        background-color: #000;
        color: #fff;
        text-decoration: none;
        padding: 1.05rem 2rem;
        margin-left: 30px;
        margin-bottom: 20px;
        font-family: 'Poppins', sans-serif;
    }

    .card__button:hover {
        background-color: #999999;
        color: #fff;
    }

    .card__color {
        background-color: white;
    }

    .imagetest2 {
        display: block;
        margin-left: auto;
        margin-right: auto;
        background-color: #000;
        margin-bottom: 20px;
        width: 20%;
    }

    .countdown {
        margin-left: auto;
    margin-right: auto;
    width: 28em;
    }

    .countdown.flip-clock-wrapper ul li a div div.inn {
    background-color: #000;
    color: #ffa019;
    font-size: 70px;
    text-shadow: 0 1px 2px #000;
  }


    @media (max-width: 1007px) {
        .imagetest2 {
            width: 50%;
        }
    }
</style>
<video autoplay muted loop class="bg_video">
    <source src="/videos/istockphoto-891971742-640_adpp_is.mp4" type="video/mp4">
</video>
<main id="main" class="main">
    <div class="card">
        <div class="card__content">
            <h2 class="card__title"><img class="imagetest2" src="{{asset('images/nolimitslogo.png')}}" alt=""></h2>
            <div class="card__color">
                <div class="card-header bbcolorp">
                    <div id="countdown" class="countdown text-center"></div>
                </div>
                <div class="container text-center">
                    <div class="row">
                        <div class="col card__desc">
                            USD:
                            <p class="card__price">QRCODE</p>
                        </div>
                        <div class="col card__desc">
                            BTC:
                            <p class="card__price">QRCODE</p>
                        </div>
                        <div class="col card__desc">
                            EUR:
                            <p class="card__price">QRCODE</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    (function() {
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