@extends('adminlte::page')
@section('title', 'Packages')

@section('content_header')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1> Admin Order</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">
              Admin Order
            </a></li>
          <li class="breadcrumb-item active">
            {{-- @lang('admin.package.subtitle2') --}}
            Admin Order
          </li>
        </ol>
      </div>
    </div>
  </div>
@stop

@section('content')
  @include('flash::message')
  <div class="row d-flex justify-content-center ">
    <div class="col-lg-6">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">
            {{-- @lang('admin.unilevel.titlecreate2') --}}
            Admin Order
          </h3>
        </div>
        <form action=" {{ route('admin.order-admin.payment.admin') }} " method="POST" enctype="multipart/form-data">
          <div class="card-body">
            @csrf
            <div class="form-group">
              <label for="level">
                Username
                <span class="text-danger">*</span>
              </label>
              <input type="text" class="form-control form-control-lg @error('username') is-invalid @enderror"
                id="username" name="username" placeholder="Username" value="{{ old('username') }}">
              @error('username')
                <span class="error invalid-feedback">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="level">
                Package
                <span class="text-danger">*</span>
              </label>

              <select name="package" id=""
                class="form-control form-control-lg @error('package') is-invalid @enderror" onchange="getPrice(this)">
                <option value="" selected disabled> Choose a package</option>
                @foreach ($packages as $package)
                  <option value=" {{ $package->id }} " data-value="{{ $package->price }} "> {{ $package->name }} - $
                    {{ number_format($package->price, 2, ',', '.') }}</option>
                @endforeach
              </select>

              @error('package')
                <span class="error invalid-feedback">{{ $message }}</span>
              @enderror
            </div>


            <div class="form-group" id="price-status">
              <label for="price">
                New Price
              </label>
              <input type="number" class="form-control form-control-lg @error('price') is-invalid @enderror"
                id="price" name="price_new" placeholder="Price" value="{{ old('price') }}">
              @error('price')
                <span class="error invalid-feedback">{{ $message }}</span>
              @enderror
            </div>


            <div class="form-group">
              <label for="level">
                <span class="text-danger">*</span>
                Payment Type
              </label>

              <select name="payment" id=""
                class="form-control form-control-lg @error('payment') is-invalid @enderror">
                <option value="" disabled> Choose a package</option>
                <option value="BTC">Buy Now (BTC) </option>
                <option value="USDT">Buy Now (USDT TRC20) </option>
              </select>

              @error('payment')
                <span class="error invalid-feedback">{{ $message }}</span>
              @enderror
            </div>

          </div>

      </div>
      <div class="card-footer text-right">
        <button type="submit" class="btn brn-lager btn-success">@lang('admin.unilevel.register')</button>
      </div>
      </form>
    </div>
  </div>


@stop

@section('js')
  <script>
    $("#price-status").hide()

    function getPrice(select) {
      // console.log(select)
      $("#price-status").show();
      $("#price").val(select.textContent)
    }
  </script>
@stop
