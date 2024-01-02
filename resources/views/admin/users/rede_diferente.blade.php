@extends('adminlte::page')

@section('title', 'User Network')

@section('content_header')
    <div class="alignHeader">
        <h4>User Network</h4>
    </div>
@stop

@section('content')
    <style>
        .content-wrapper {
            background-color: transparent !important;
        }
    </style>
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
    <script src="{{ URL::asset('js/tree-maker.js') }}"></script>
    <div id="my_tree">

    </div>

    <script type="text/javascript">
        let tree = {!! $tree !!};

        let params = {!! $params !!};

        treeMaker.default(tree, {
            id: 'my_tree',
            card_click: function(element) {
                console.log(element);
            },
            treeParams: params,
            'link_width': '4px',
            'link_color': '#2199e8',
        });
    </script>
@stop
