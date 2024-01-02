@extends('adminlte::page')

@section('title', 'User Network')
<script src="https://balkangraph.com/js/latest/OrgChart.js"></script>
<style>
    .Inactive {
        stroke: #ff0000;
    }

    .PreRegistration {
        stroke: #3700ff;
    }

    .AllCards {
        stroke: #15ff00;
    }
    .details-view{
        display: none !important;
    }

    .edit-wrapper{
        display: none !important;
    }
    
</style>
@section('content_header')
    <div class="alignHeader">
        <h4>User Network</h4>
    </div>
@stop

@section('content')

    <div style="width:100%; height:700px;" id="tree" />

@stop

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
</script>
@section('js')
    <script>
        OrgChart.templates.olivia.field_2 =
            '<text data-width="50" style="font-size: 14px;" fill="#757575" x="195" y="100">{val}</text>';
        var chart = new OrgChart(document.getElementById("tree"), {
            // enableTouch: true,
            nodeBinding: {
                field_0: "name",
                //    field_1: "volume",
                field_2: "btn",
                img_0: "img"
            },
            template: "olivia",
            tags: {
                "Inactive": {},
            },
            editForm: {
                addMore: 'Add more elements',
                addMoreBtn: 'Add element',
                addMoreFieldName: 'Element name',
            },
            nodes: {!! $networks !!}


        });
    </script>

@stop
