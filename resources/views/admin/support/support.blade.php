@extends('adminlte::page')

@section('title', 'Support')

@section('content_header')
<h4>@lang('admin.support.title')</h4>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <h3>@lang('admin.support.unanswered')</h3>
    </div>
    <div class="card-body table-responsive">
        <div class="form-group float-right">
            <input type="text" class="search form-control" placeholder="@lang('admin.btn.search')">
        </div>
        <span class="counter float-right"></span>
        <table class="table table-hover table-bordered results">
            <thead>
                <tr>
                    <th>@lang('admin.support.chat.col1')</th>
                    <th>@lang('admin.support.chat.col2')</th>
                    <th>@lang('admin.support.chat.col3')</th>
                    <th>@lang('admin.support.chat.col4')</th>
                    <th>@lang('admin.support.chat.col5')</th>
                </tr>
                <tr class="warning no-result">
                    <td colspan="4"><i class="fa fa-warning"></i>@lang('admin.btn.noresults')</td>
                </tr>
            </thead>
            <tbody>
                @forelse($unanswereds as $unanswered)
                <tr>
                    <th>{{$unanswered->user_name}}</th>
                    <td>{{$unanswered->title}}</td>
                    <td>{{$unanswered->text}}</td>
                    <td>{{$unanswered->date}}</td>
                    @switch($unanswered->status)
                    @case(0)
                    <td>
                        <button class="btn btn-primary btn-sm m-0" onclick="location.href = '{{ route('admin.answerChat', $unanswered->id) }}'">@lang('admin.support.chat.answer')</button>
                        <button class="btn btn-danger btn-sm m-0" onclick="location.href = '{{ route('admin.closeChat', $unanswered->id) }}'">@lang('admin.support.chat.close')</button>
                    </td>
                    @break
                    @case(1)
                    <td>
                        <button class="btn btn-primary btn-sm m-0" onclick="location.href = '{{ route('admin.answerChat', $unanswered->id) }}'">@lang('admin.support.chat.answer')</button>
                        <button class="btn btn-danger btn-sm m-0" onclick="location.href = '{{ route('admin.closeChat', $unanswered->id) }}'">@lang('admin.support.chat.close')</button>
                    </td>
                    @break
                    @default
                    <td><button class="btn btn-primary btn-sm m-0" onclick="location.href = '{{ route('admin.reopenChat', $unanswered->id) }}'">@lang('admin.support.chat.reopen')</button></td>
                    @endswitch
                </tr>
                @empty
                <p>@lang('admin.support.chat.empty')</p>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>@lang('admin.support.answered')</h3>
    </div>
    <div class="card-body table-responsive">
        <div class="form-group float-right">
            <input type="text" class="search form-control" placeholder="@lang('admin.btn.search')">
        </div>
        <span class="counter float-right"></span>
        <table class="table table-hover table-bordered results">
            <thead>
                <tr>
                    <th>@lang('admin.support.chat.col1')</th>
                    <th>@lang('admin.support.chat.col2')</th>
                    <th>@lang('admin.support.chat.col3')</th>
                    <th>@lang('admin.support.chat.col4')</th>
                    <th>@lang('admin.support.chat.col5')</th>
                </tr>
                <tr class="warning no-result">
                    <td colspan="4"><i class="fa fa-warning"></i>@lang('admin.btn.noresults')</td>
                </tr>
            </thead>
            <tbody>
                @forelse($answereds as $answered)
                <tr>
                    <th>{{$answered->user_name}}</th>
                    <td>{{$answered->title}}</td>
                    <td>{{$answered->text}}</td>
                    <td>{{$answered->date}}</td>
                    @switch($answered->status)
                    @case(0)
                    <td>
                        <button class="btn btn-primary btn-sm m-0" onclick="location.href = '{{ route('admin.answerChat', $answered->id) }}'">@lang('admin.support.chat.answer')</button>
                        <button class="btn btn-danger btn-sm m-0" onclick="location.href = '{{ route('admin.closeChat', $answered->id) }}'">@lang('admin.support.chat.close')</button>
                    </td>
                    @break
                    @case(1)
                    <td>
                        <button class="btn btn-primary btn-sm m-0" onclick="location.href = '{{ route('admin.answerChat', $answered->id) }}'">@lang('admin.support.chat.answer')</button>
                        <button class="btn btn-danger btn-sm m-0" onclick="location.href = '{{ route('admin.closeChat', $answered->id) }}'">@lang('admin.support.chat.close')</button>
                    </td>
                    @break
                    @default
                    <td><button class="btn btn-primary btn-sm m-0" onclick="location.href = '{{ route('admin.reopenChat', $answered->id) }}'">@lang('admin.support.chat.reopen')</button></td>
                    @endswitch
                </tr>
                @empty
                <p>@lang('admin.support.chat.empty2')</p>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>@lang('admin.support.closed')</h3>
    </div>
    <div class="card-body table-responsive">
        <div class="form-group float-right">
            <input type="text" class="search form-control" placeholder="@lang('admin.btn.search')">
        </div>
        <span class="counter float-right"></span>
        <table class="table table-hover table-bordered results">
            <thead>
                <tr>
                    <th>@lang('admin.support.chat.col1')</th>
                    <th>@lang('admin.support.chat.col2')</th>
                    <th>@lang('admin.support.chat.col3')</th>
                    <th>@lang('admin.support.chat.col4')</th>
                    <th>@lang('admin.support.chat.col5')</th>
                </tr>
                <tr class="warning no-result">
                    <td colspan="4"><i class="fa fa-warning"></i>@lang('admin.btn.noresults')</td>
                </tr>
            </thead>
            <tbody>
                @forelse($closeds as $closed)
                <tr>
                    <th>{{$closed->user_name}}</th>
                    <td>{{$closed->title}}</td>
                    <td>{{$closed->text}}</td>
                    <td>{{$closed->date}}</td>
                    @switch($closed->status)
                    @case(0)
                    <td>
                        <button class="btn btn-primary btn-sm m-0" onclick="location.href = '{{ route('admin.answerChat', $closed->id) }}'">@lang('admin.support.chat.answer')</button>
                        <button class="btn btn-danger btn-sm m-0" onclick="location.href = '{{ route('admin.closeChat', $closed->id) }}'">@lang('admin.support.chat.close')</button>
                    </td>
                    @break
                    @case(1)
                    <td>
                        <button class="btn btn-primary btn-sm m-0" onclick="location.href = '{{ route('admin.answerChat', $closed->id) }}'">@lang('admin.support.chat.answer')</button>
                        <button class="btn btn-danger btn-sm m-0" onclick="location.href = '{{ route('admin.closeChat', $closed->id) }}'">@lang('admin.support.chat.close')</button>
                    </td>
                    @break
                    @default
                    <td><button class="btn btn-primary btn-sm m-0" onclick="location.href = '{{ route('admin.reopenChat', $closed->id) }}'">@lang('admin.support.chat.reopen')</button></td>
                    @endswitch
                </tr>
                @empty
                <p>@lang('admin.support.chat.empty3')</p>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@stop
@section('css')
<link rel="stylesheet" href="{{ asset('/css/admin_custom.css') }}">
@stop

@section('js')
<script>
    $(document).ready(function() {
        $(".search").keyup(function() {
            var searchTerm = $(".search").val();
            var listItem = $('.results tbody').children('tr');
            var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

            $.extend($.expr[':'], {
                'containsi': function(elem, i, match, array) {
                    return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
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