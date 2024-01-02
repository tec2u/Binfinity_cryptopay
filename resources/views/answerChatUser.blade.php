@extends('layouts.header')
@section('content')

    <main id="main" class="main">
        <section id="supporttickets" class="content">
            <div class="fade">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <h1>@lang('support.support_tickets')</h1>
                            <div class="card shadow my-3">
                                <div class="card-header bbcolorp">
                                    <h3 class="card-title">@lang('support.tickets')</h3>
                                    <div class="card-tools">
                                        <div class="input-group input-group-sm pt-3" style="width: 250px;">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-primary btn-sm rounded-pill"
                                                    style="width: 220px;" data-bs-toggle="modal"
                                                    data-bs-target="#withdrawrequestModal">
                                                    <i class="bi bi-plus-lg"></i>
                                                    @lang('support.new_tickets')
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body table-responsive p-0">
                                    <div class="card-body table-responsive">
                                        @forelse($messages as $message)
                                            <div class="form-group">
                                                <p>@lang('support.chat.col1'): {{ $message->user_name }}</p>
                                                <p>@lang('support.chat.col2'): {{ $message->title }}</p>
                                                <p>@lang('support.chat.col4'): {{ $message->date }}</p>
                                                <p>@lang('support.chat.message'): {{ $message->text }}</p>
                                                <form action="" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="chat_id" value="{{ $message->id }}">
                                                    <input type="text" name="text" class="answer form-control"
                                                        placeholder="@lang('support.chat.answer')">
                                                    <button type="submit"
                                                        class="btn btn-primary btn-sm m-0 float-right">@lang('support.chat.answer')</button>
                                                </form>
                                            </div>
                                        @empty
                                            <p>@lang('support.chat.error')</p>
                                        @endforelse
                                    </div>
                                </div>

                                <div class="card-footer clearfix py-3">
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="@lang('support.close')"></button>
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
