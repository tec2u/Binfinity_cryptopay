@extends('layouts.header')
@section('content')
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
