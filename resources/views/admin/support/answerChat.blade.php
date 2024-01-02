@extends('adminlte::page')

@section('title', 'Support')

@section('content_header')
<h4>@lang('admin.support.title')</h4>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <h3>@lang('admin.support.title2')</h3>
    </div>
    <div class="card-body table-responsive">
        <div class="form-group float-right">
            <input type="text" class="search form-control" placeholder="@lang('admin.btn.search')">
        </div>
        @forelse($messages as $message)
        <div class="form-group">
            <p>@lang('admin.support.chat.col1'): {{$message->user_name}}</p>
            <p>@lang('admin.support.chat.col2'): {{$message->title}}</p>
            <p>@lang('admin.support.chat.col4'): {{$message->date}}</p>
            <p>@lang('admin.support.chat.message'): {{$message->text}}</p>
            <form action="" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="chat_id" value="{{$message->id}}">
                <input type="text" name="text" class="answer form-control" placeholder="@lang('admin.support.chat.answer')">
                <button type="submit" class="btn btn-primary btn-sm m-0 float-right">@lang('admin.support.chat.answer')</button>
            </form>
        </div>
        @empty
        <p>@lang('admin.support.chat.error')</p>
        @endforelse
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