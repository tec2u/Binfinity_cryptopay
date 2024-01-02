@extends('layouts.header')
@section('content')
    {{-- <script src="https://balkangraph.com/js/latest/OrgChart.js"></script> --}}
    <script src="{{ asset('js/orgchart.js') }}"></script>
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

        .boc-edit-form{
            display: none !important;
        }

        .boc-edit-form-fields{
            display: none !important;
        }
        
    </style>
    <main id="main" class="main">
        <div id="tree" />
    </main>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script> --}}

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
            editForm: {
                addMore: 'Add more elements',
                addMoreBtn: 'Add element',
                addMoreFieldName: 'Element name',
            },
            tags: {
                "Inactive": {},
            },
            nodes: {!! $networks !!}
        });
    </script>


@stop
