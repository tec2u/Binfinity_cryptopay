@extends('adminlte::page')

@section('title', 'Settings')

@section('content_header')
  <div class="alignHeader">
    <h4>@lang('admin.myinfo.title')</h4>
  </div>
@stop

@section('content')
  @include('flash::message')
  <div class="card">
    <div class="card-body">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-lg-12 col-xl-12 mx-auto">
            <form action="{{ route('admin.users.updateTax', ['id' => $user->id]) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="form-row">

                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Coin</th>
                      <th scope="col">Tax Bin %</th>
                      <th scope="col">Tax fee (dollares)</th>
                      <th scope="col">Verification margin (dollares)</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($coins as $item)
                      <tr>
                        <th scope="row">{{ $item }}</th>
                        <td>
                          <input min="0" type="number" step="0.1" name="{{ $item }}_tx_bin"
                            value="{{ $taxByCoin[$item][0]->tx_bin }}">
                        </td>

                        <td>
                          <input min="0" type="number" step="0.1" name="{{ $item }}_tx_gas"
                            value="{{ $taxByCoin[$item][0]->tx_gas }}">
                        </td>

                        <td>
                          <input min="1" type="number" step="0.1"
                            name="{{ $item }}_verification_margin_dol"
                            value="{{ $taxByCoin[$item][0]->verification_margin_dol }}">
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>


              </div>
              <hr class="my-4" />
              <button type="submit" class="btn btn-warning">@lang('admin.myinfo.save')</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>





@stop
@section('css')
  <link rel="stylesheet" href="{{ asset('/css/admin_custom.css') }}">
@stop
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
@section('js')
  <script>
    $(document).ready(function() {
      $(".search").keyup(function() {
        var searchTerm = $(".search").val();
        var listItem = $('.results tbody').children('tr');
        var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

        $.extend($.expr[':'], {
          'containsi': function(elem, i, match, array) {
            return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "")
              .toLowerCase()) >= 0;
          }
        });

        $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e) {
          $(this).attr('visible', 'false');
        });

        $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e) {
          $(this).attr('visible', 'true');
        });

        var jobCount = $('.results tbody tr[visible="true"]').length;
        $('.counter').text(jobCount + ' item');

        if (jobCount == '0') {
          $('.no-result').show();
        } else {
          $('.no-result').hide();
        }
      });
    });
  </script>
@stop
