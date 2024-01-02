@extends('layouts.header')
@section('content')

<main id="main" class="main">
    <section id="monthlycoins" class="content">
        <div class="fade">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h1>Monthly Coins</h1>
                        <div class="card shadow my-3">
                            <div class="card-header bbcolorp">
                                <h3 class="card-title">Coins</h3>
                            </div>
                            <div class="card-header py-3">
                                <!-- <button type="button" class="btn btn-info btn-sm rounded-pill" style="width: 80px;">CSV</button>
                                 <button type="button" class="btn btn-success btn-sm rounded-pill" style="width: 80px;">Excel</button>
                                 <button type="button" class="btn btn-danger btn-sm rounded-pill" style="width: 80px;">PDF</button> -->
                                <div class="card-tools">
                                    <div class="input-group input-group-sm my-1" style="width: 250px;">
                                        <input type="text" name="table_search" class="form-control float-right rounded-pill pl-3" placeholder="Search">
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
                                            <th>ID</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Order Id</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($monthly_coins as $monthly_coin)
                                        <tr>
                                            <td>{{$monthly_coin->id}}</td>
                                            <td>{{$monthly_coin->config_bonus->description}}</td>
                                            <td>$ {{number_format($monthly_coin->price,2, ',', '.')}}</td>
                                            <td>{{$monthly_coin->order_id}}</td>
                                            <td>{{date('d/m/Y',strtotime($monthly_coin->created_at))}}</td>
                                        </tr>
                                        @empty
                                        <p class="m-4 fst-italic">You don't have any Reward registered!</p>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix py-3">
                                {{$monthly_coins->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection