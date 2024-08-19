@extends('layouts.layout')

@section('content')
    <section class="home_page px-3">
        <div class="card w-100 mb-3">
            <a href={{ route("lot.index") }}>
                <div class="card-body">
                    <h5 class="card-title mb-4">Lot</h5>
                    <a href={{ route('lot.add') }} class="btn btn-success btn-sm">Add</a>
                    {{-- <a href={{ route("lot.index") }} class="btn btn-primary btn-sm">Listing</a> --}}
                </div>
            </a>
        </div>
        <div class="card w-100 mb-3">
            <a href={{ route("party.index") }}>
                <div class="card-body">
                    <h5 class="card-title mb-4">Party</h5>
                    <a href={{ route('party.add') }} class="btn btn-success btn-sm">Add</a>
                    {{-- <a href={{ route("lot.index") }} class="btn btn-primary btn-sm">Listing</a> --}}
                </div>
            </a>
        </div>
    </section>
@endsection
