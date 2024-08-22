@extends('layouts.layout')

@section('content')
    <section class="home_page px-3 d-flex flex-wrap">
        <div class="card mb-3 w-50">
            <a href={{ route("lot.index") }}>
                <div class="card-body">
                    <h5 class="card-title mb-4">Lot</h5>
                    {{-- <a href={{ route('lot.add') }} class="btn btn-success btn-sm">Add</a> --}}
                    {{-- <a href={{ route("lot.index") }} class="btn btn-primary btn-sm">Listing</a> --}}
                </div>
            </a>
        </div>
        <div class="card mb-3 w-50">
            <a href={{ route("party.index") }}>
                <div class="card-body">
                    <h5 class="card-title mb-4">Party</h5>
                    {{-- <a href={{ route('party.add') }} class="btn btn-success btn-sm">Add</a> --}}
                    {{-- <a href={{ route("party.index") }} class="btn btn-primary btn-sm">Listing</a> --}}
                </div>
            </a>
        </div>
        <div class="card mb-3 w-50">
            <a href={{ route("worker.index") }}>
                <div class="card-body">
                    <h5 class="card-title mb-4">Worker</h5>
                    {{-- <a href={{ route('worker.add') }} class="btn btn-success btn-sm">Add</a> --}}
                    {{-- <a href={{ route("lot.index") }} class="btn btn-primary btn-sm">Listing</a> --}}
                </div>
            </a>
        </div>
        <div class="card mb-3 w-50">
            <a href={{ route("workerType.index") }}>
                <div class="card-body">
                    <h5 class="card-title mb-4">Worker Type</h5>
                    {{-- <a href={{ route('workerType.add') }} class="btn btn-success btn-sm">Add</a> --}}
                    {{-- <a href={{ route("lot.index") }} class="btn btn-primary btn-sm">Listing</a> --}}
                </div>
            </a>
        </div>
    </section>
@endsection
