@extends('layouts.layout')

@section('content')
    <section class="home_page px-3">
        <div class="card w-100 mb-3">
            <div class="card-body">
                <h5 class="card-title mb-4">Stock</h5>
                <a href={{ route("lot.add") }} class="btn btn-success btn-sm">Add</a>
                <a href={{ route("lot.index") }} class="btn btn-primary btn-sm">Listing</a>
            </div>
        </div>
        <div class="card w-100 mb-3">
            <div class="card-body">
                <h5 class="card-title mb-4">Worker</h5>
                <a href="#" class="btn btn-success btn-sm">Add</a>
                <a href="#" class="btn btn-primary btn-sm">Listing</a>
            </div>
        </div>
    </section>
@endsection
