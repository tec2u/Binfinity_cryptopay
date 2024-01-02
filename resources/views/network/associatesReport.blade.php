@extends('layouts.header')
@section('content')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
    integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <style>
    .hiddenRow {
      padding: 0 !important;
    }
  </style>

  <main id="main" class="main">
    <section id="supporttable" class="content">
      <div class="fade">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <!-- <h1>@lang('support.support_tickets')</h1> -->
              <h1 class="up font">MY TEAM</h1>
              <div class="card shadow my-3">


                <div class="table-responsive">

                  <table class="table accordion table-hover">
                    <thead>
                      <tr class="up font">
                        <th scope="col"></th>
                        <th scope="col">Name</th>
                        {{-- <th scope="col">@lang('network.name')</th> --}}
                        <th scope="col">@lang('network.sponsor')</th>
                        <th scope="col">@lang('network.coutry')</th>
                        <th scope="col">@lang('network.email')</th>
                        <th scope="col">GROUP VOLUME</th>
                      </tr>
                    </thead>
                    <tbody>
                      <div>


                        @forelse($networks as $network)
                          @php

                            $user_id = ucwords(auth()->user()->id);

                            $user_qr = Illuminate\Support\Facades\DB::select("SELECT * FROM users where id=$network->user_id;");
                            $user_final = isset($user_qr[0]->{'name'}) ? $user_qr[0]->{'name'} : 0;
                            $user_country = isset($user_qr[0]->{'country'}) ? $user_qr[0]->{'country'} : 0;
                            $user_email = isset($user_qr[0]->{'email'}) ? $user_qr[0]->{'email'} : 0;

                            $indirectVolume = Illuminate\Support\Facades\DB::select("SELECT sum(score) as total FROM historic_score where user_id=$network->user_id and level_from>=0 and level_from<'5'   ");
                            $indirectVolume = isset($indirectVolume[0]->{'total'}) ? $indirectVolume[0]->{'total'} : 0;

                            $totalVolume = $indirectVolume;

                          @endphp

                          @if ($user_final != 0)
                            <tr scope="row" data-bs-toggle="collapse" data-bs-target="#id{{ $network->id }}"
                              value="{{ $network->id }}">
                              <td>{{-- <button id="botao{{$network->id}}" onclick="getdiretos({{$network->id}})" class="btn btn-primary">+</button> --}}</td>
                              <td>{{ $user_final }}</td>
                              {{-- <td>{{$network->user->name}}</td> --}}
                              <td>{{ $network->getReferalName($network->upline_id) }}</td>
                              <td>{{ $user_country }}</td>
                              <td>{{ $user_email }}</td>
                              <td id="nivel{{ $network->id }}">{{ $totalVolume }} </td>
                            </tr>
                            <tr>
                              <td id="local{{ $network->id }}" style="display: none; padding: 0px" colspan="9">
                              </td>
                            </tr>
                          @endif
                        @empty
                          <p>@lang('network.any_referrals_registered')</p>
                        @endforelse
                      </div>
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <div id="loading">
    <img id="loading-image" src="gif.gif" alt="Loading..." />
  </div>

  <script type="text/javascript">
    function getdiretos(id) {

      var nivel = $('#nivel' + id).html();
      if ($('#local' + id).css('display') === 'none') {
        nivel++;
        $('#botao' + id).html("-");
        var login = id;
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          url: 'associates/pesquisa',
          type: 'POST',
          data: {
            login: login
          },
          dataType: 'json',
          beforeSend: function() {
            $('#loading').show();
          },
          success: function(data) {
            if (data.error) {
              var tabela =
                "<table class='table accordion table-hover'><tr><td colspan ='9'>Não há diretos</td></tr></table>";
              $('#local' + login).html('');
              $('#local' + login).append(tabela);
              $('#local' + login).show('slow');
              return false;
            }
            var tabela = "<table class='table accordion table-hover'>"


              +
              "<thead>" +
              "<tr>" +
              "<th scope='col'></th>" +
              "<th scope='col'>@lang('network.login')</th>"
              // +"<th scope='col'>@lang('network.name')</th>"
              +
              "<th scope='col'>@lang('network.sponsor')</th>" +
              "<th scope='col'>@lang('network.coutry')</th>" +
              "<th scope='col'>@lang('network.email')</th>" +
              "<th scope='col'>@lang('network.level')</th>" +
              "</tr>" +
              "</thead>";


            for (var i = 0; i < data.length; i++) {
              tabela += "<tr scope='row' data-bs-toggle='collapse' data-bs-target='#id" + data[i]['id'] +
                "' value='" + data[i]['id'] + "'>";
              tabela += "<td><button id='botao" + data[i]['id'] + "' onclick='getdiretos(" + data[i]['id'] +
                ")' class='btn btn-primary'>+</button></td>";
              tabela += "<td>" + data[i]['login'] + "</td>";
              // tabela += "<td>"+data[i]['name']+"</td>";
              tabela += "<td>" + data[i]['patrocinador'] + "</td>";
              tabela += "<td>" + data[i]['country'] + "</td>";
              tabela += "<td>" + data[i]['email'] + "</td>";
              tabela += "<td id='nivel" + data[i]['id'] + "'>" + nivel + "</td>";
              tabela += "</tr>";
              tabela += "<tr>";
              tabela += "<td id='local" + data[i]['id'] + "' style='display:none; padding:0px;' colspan='9'>";
              tabela += "</td>";
              tabela += "</tr>";
            }
            tabela += "</tbody></table>";

            $('#local' + login).html('');
            $('#local' + login).append(tabela);
            $('#local' + login).show('slow');

          },
          complete: function() {

            $('#loading').hide();
          }
        });
      } else {
        nivel--;
        $('#local' + id).hide('slow');
        $('#local' + id).html("");
        $('#botao' + id).html("+");
      }
    };
    $(document).ready(function() {
      $('#loading').hide();
    });
  </script>


@endsection
@section('css')
@stop
