@extends('layouts.header')
@section('content')
  <main id="main" class="main">
    @include('flash::message')
    <section id="userpackageinfo" class="content">
      <div class="fade">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <h1>Ip's allowed</h1>
              <div class="card shadow my-3" style="overflow-x: auto">
                <div class="card-header bbcolorp">
                  <form action="{{ route('users.ipAllowedStore') }}" method="post" class="d-flex">
                    @csrf
                    <input type="text" name="ip" id="" required>
                    <h3 class="card-title"><button type="submit" style="color:white" class="btn btn-warning">Add
                        +</button>
                    </h3>
                  </form>
                </div>

                <table class="table">
                  <thead>
                    <tr>
                      {{-- <th scope="col">#</th> --}}
                      <th scope="col">IP</th>
                      <th scope="col">Date</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($ips as $item)
                      <form action="{{ route('users.ipAllowedDelete') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $item->id }}" name="id">
                        <tr>
                          {{-- <th scope="row">{{}}</th> --}}
                          <td><input type="text" name="ip" id="" value="{{ $item->ip }}" readonly
                              disabled>
                          </td>
                          <td>{{ $item->created_at }}</td>
                          <td> <button type="submit" style="color:white" class="btn btn-danger">Delete</button> </td>
                        </tr>
                      </form>
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
