@extends('layouts.header')
@section('content')
  <main id="main" class="main">
    @include('flash::message')
    <section id="userpackageinfo" class="content">
      <div class="fade">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <h1>Transactions</h1>
              <div class="card shadow my-3" style="overflow-x: auto">

                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">address</th>
                      <th scope="col">coin</th>
                      <th scope="col">status</th>
                      <th scope="col">value</th>
                      <th scope="col">value payed</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($transactions as $item)
                      <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->wallet }}</td>
                        <td>{{ $item->coin }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->price_crypto * 1 }}</td>
                        @if (isset($item->price_crypto_payed))
                          <td>{{ $item->price_crypto_payed * 1 }}</td>
                        @else
                          <td>{{ 0 }}</td>
                        @endif
                      </tr>
                    @endforeach

                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
