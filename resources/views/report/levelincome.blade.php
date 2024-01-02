@extends('layouts.header')
@section('content')

<main id="main" class="main">
    <section id="levelincome" class="content">
        <div class="fade">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h1>@lang('reports.level_income.title')</h1>
                        <div class="card shadow my-3">
                            <div class="card-header bbcolorp">
                                <h3 class="card-title">@lang('reports.level_income.title1')</h3>
                            </div>
                            <div class="card-header py-3">
                                <!-- <button type="button" class="btn btn-info btn-sm rounded-pill" style="width: 80px;">CSV</button>
                            <button type="button" class="btn btn-success btn-sm rounded-pill" style="width: 80px;">Excel</button>
                            <button type="button" class="btn btn-danger btn-sm rounded-pill" style="width: 80px;">PDF</button> -->
                                <div class="card-tools">
                                    <div class="input-group input-group-sm my-1" style="width: 250px;">
                                        <input type="text" name="table_search" class="form-control float-right rounded-pill pl-3" placeholder="@lang('withdraw.search')">
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
                                            <th>Id</th>
                                            <th>@lang('reports.level_income.descr')</th>
                                            <th>@lang('reports.level_income.price')</th>
                                            <th>>@lang('reports.level_income.from')</th>
                                            <th>@lang('reports.level_income.id_order')</th>
                                            <th>@lang('reports.level_income.date')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($scores as $score)
                                        <tr>
                                            <th>{{$score->id}}</th>
                                            <td>{{$score->config_bonus->description}}</td>
                                            <td>$ {{number_format($score->price,2, ',', '.')}}</td>
                                            <td>{{$score->getUserOrder($score->order_id)}}</td>
                                            <td>{{$score->order_id}}</td>
                                            <td>{{date('d/m/Y',strtotime($score->created_at))}}</td>
                                        </tr>
                                        @empty
                                        <p class="m-4 fst-italic">@lang('reports.level_income.empyt')</p>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix py-3">
                                {{$scores->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection