@extends('layouts.header')
@section('content')
  <main id="main" class="main">
    <section id="supporttickets" class="content">
      <div class="fade">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <h1 class="font up">@lang('support.support_tickets')</h1>
              <div class="card shadow my-3">
                <div class="card-header bbcolorp">
                  <h3 class="card-title font up">@lang('support.tickets')</h3>
                  <div class="card-tools">
                    <div class="input-group input-group-sm pt-3" style="width: 250px;">
                      <div class="input-group-append">
                        <button type="button" class="up font btn btn-primary btn-sm rounded-pill" style="width: 220px;"
                          data-bs-toggle="modal" data-bs-target="#withdrawrequestModal">
                          <i class="bi bi-plus-lg"></i>
                          @lang('support.new_tickets')
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-header py-3">
                  <!-- <button type="button" class="btn btn-info btn-sm rounded-pill" style="width: 80px;">CSV</button>
                                          <button type="button" class="btn btn-success btn-sm rounded-pill" style="width: 80px;">Excel</button>
                                          <button type="button" class="btn btn-danger btn-sm rounded-pill" style="width: 80px;">PDF</button> -->
                  <div class="card-tools">
                    <div class="input-group input-group-sm my-1" style="width: 250px;">
                      <input type="text" name="table_search" class="form-control float-right rounded-pill pl-3"
                        placeholder="@lang('support.search')">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="bi bi-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>@lang('support.id')</th>
                        <th>@lang('support.subject')</th>
                        <th>@lang('support.message')</th>
                        <th>@lang('support.status')</th>
                        <th>@lang('support.date')</th>
                        <th>@lang('support.action')</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($chats as $chat)
                        @foreach ($chat->message as $message)
                          @if ($loop->first)
                            <tr class="header-table">
                              <td>{{ $chat->id }}</td>
                              <td>{{ $chat->title }}</td>
                              <td>{{ $message->text }}</td>
                              <td>
                                @if ($chat->status == 0)
                                  <span class="rounded-pill bg-secondary px-4 py-1">@lang('support.sent')</span>
                                @elseif($chat->status == 1)
                                  <span class="rounded-pill bg-info px-4 py-1">@lang('support.answered')</span>
                                @else
                                  <span class="rounded-pill bg-success px-4 py-1">@lang('support.finished')</button>
                                @endif
                              </td>
                              <td>{{ date('d/m/Y', strtotime($message->created_at)) }}</td>
                              @switch($chat->status)
                                @case(0)
                                  <td>
                                    <button class="btn btn-danger btn-sm m-0"
                                      onclick="location.href = '{{ route('supports.closeChat', $chat->id) }}'">@lang('support.chat.close')</button>
                                  </td>
                                @break

                                @case(1)
                                  <td>
                                    <button class="btn btn-primary btn-sm m-0"
                                      onclick="location.href = '{{ route('supports.answerChat', $chat->id) }}'">@lang('support.chat.answer')</button>
                                    <button class="btn btn-danger btn-sm m-0"
                                      onclick="location.href = '{{ route('supports.closeChat', $chat->id) }}'">@lang('support.chat.close')</button>
                                  </td>
                                @break

                                @default
                                  <td><button class="btn btn-primary btn-sm m-0"
                                      onclick="location.href = '{{ route('supports.reopenChat', $chat->id) }}'">@lang('support.chat.reopen')</button>
                                  </td>
                              @endswitch
                            </tr>
                          @else
                            <tr style="display: none">
                              <td>&rsaquo;&rsaquo;&rsaquo;</td>
                              <td>{{ $chat->title }}</td>
                              <td>{{ $message->text }}</td>
                              <td>
                                @if ($chat->status == 0)
                                  <span class="rounded-pill bg-secondary px-4 py-1">@lang('support.sent')</span>
                                @elseif($chat->status == 1)
                                  <span class="rounded-pill bg-info px-4 py-1">@lang('support.answered')</span>
                                @else
                                  <span class="rounded-pill bg-success px-4 py-1">@lang('support.finished')</button>
                                @endif
                              </td>
                              <td></td>
                              @switch($chat->status)
                                @case(0)
                                  <td>
                                    <button class="btn btn-danger btn-sm m-0"
                                      onclick="location.href = '{{ route('supports.closeChat', $chat->id) }}'">@lang('support.chat.close')</button>
                                  </td>
                                @break

                                @case(1)
                                  <td>
                                    <button class="btn btn-primary btn-sm m-0"
                                      onclick="location.href = '{{ route('supports.answerChat', $chat->id) }}'">@lang('support.chat.answer')</button>
                                    <button class="btn btn-danger btn-sm m-0"
                                      onclick="location.href = '{{ route('supports.closeChat', $chat->id) }}'">@lang('support.chat.close')</button>
                                  </td>
                                @break

                                @default
                                  <td><button class="btn btn-primary btn-sm m-0"
                                      onclick="location.href = '{{ route('supports.reopenChat', $chat->id) }}'">@lang('support.chat.reopen')</button>
                                  </td>
                              @endswitch
                            </tr>
                          @endif
                        @endforeach
                        </tr>
                    </tbody>
                    @empty
                      <p class="m-4 fst-italic">@lang('support.any_ticket_registered')</p>
                      @endforelse
                    </table>
                  </div>
                  <div class="card-footer clearfix py-3">
                    <ul class="pagination pagination-sm m-0 float-right">
                      {{ $chats->links() }}
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="withdrawrequestModal" tabindex="-1" aria-labelledby="withdrawrequestLabel"
          aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="withdrawrequestLabel">@lang('support.add_ticket')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="@lang('support.close')"></button>
              </div>
              <div class="modal-body my-4">
                <form action="{{ route('supports.store') }}" method="POST">
                  @csrf
                  <div class="mb-4">
                    <label for="recipient-name" class="col-form-label">@lang('support.subject'):</label>
                    <div class="input-group">
                      <select class="form-select" name="title" id="title"
                        aria-label="Example select with button addon">
                        <option selected>@lang('support.choose')...</option>
                        <option value="Packages">@lang('support.packages')</option>
                        <option value="Withdraw">@lang('support.withdraw')</option>
                        <option value="Others">@lang('support.others')</option>
                      </select>
                    </div>
                  </div>
                  <label for="recipient-name" class="col-form-label">@lang('support.message'):</label>
                  <textarea class="form-control" name="text" id="text"></textarea>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary rounded-pill">@lang('support.submit')</button>
                    <button type="button" class="btn btn-danger rounded-pill"
                      data-bs-dismiss="modal">@lang('support.close')</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <script>
      $('tr.header-table').click(function() {
        $(this).nextUntil('tr.header-table').css('display', function(i, v) {
          return this.style.display === 'table-row' ? 'none' : 'table-row';
        });
      });
    </script>
  @endsection
  @section('css')
    <style>
      tr.header-table {
        display: table-row;
      }
    </style>
  @stop
