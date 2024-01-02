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
            <h2 class="card__title"><img class="imagetest2" src="{{asset('images/nolimitslogo.png')}}" alt="">A cool product</h2>
            <div class="card__color">
                <p class="card__desc">- Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                <p class="card__desc">- Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                <p class="card__desc">- Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                <p class="card__price">$399.99</p>
                <a href="#" class="card__button">Buy now</a>
            </div>
        </div>
    </div>
</main>
@endsection