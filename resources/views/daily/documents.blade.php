@extends('layouts.header')
@section('content')

<main id="main" class="main">
    <section id="withdrawhistory" class="content">
        <div class="fade">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <h1>Daily Main Report</h1>
                        <div class="card shadow my-3">
                            <div class="card-header bbcolorp">
                                <h3 class="card-title">Documents</h3>
                            </div>
                            <div class="card-header py-3 ">
                                <form class="row g-3" method="POST" action="{{route('documents.getDateDocuments')}}">
                                    @csrf
                                    <div class="col-auto">
                                        <label>@lang('admin.btn.firstdate'):</label>
                                    </div>
                                    <div class="col">
                                        <input type="date" class="form-control" name="fdate">
                                    </div>
                                    <div class="col-auto">
                                        <label>@lang('admin.btn.seconddate'):</label>
                                    </div>
                                    <div class="col">
                                        <input type="date" class="form-control" name="sdate">
                                    </div>
                                    <input type="submit" value="@lang('admin.btn.search')" class="btn btn-dark">
                                </form>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Download</th>
                                            <th>@lang('withdraw.date')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($documents as $document)
                                        <tr>
                                            <td>{{$document->id}}</td>
                                            <td>{{$document->title}}</td>
                                            <td><a class="btn btn-success btn-sm m-0" href="{{ route('documents.download', $document->id) }}">Download</a></td>
                                            <td>{{date('d/m/Y ', strtotime($document->created_at))}}</td>
                                        </tr>
                                        @empty
                                        <p class="m-4 fst-italic">No document registered</p>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix py-3">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    {{$documents->links()}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection