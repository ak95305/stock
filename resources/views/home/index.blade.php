@php
    $modules = [
        [
            "url" => route("lot.index"),
            "title" => "Lot",
            "desc" => "Manage Lot Listing and Assing Lots"
        ],
        [
            "url" => route("worker.index"),
            "title" => "Worker",
            "desc" => "Manage Worker Listing"
        ],
        [
            "url" => route("workerType.index"),
            "title" => "Worker Type",
            "desc" => "Manage Worker Type Listing"
        ],
        [
            "url" => route("party.index"),
            "title" => "Party",
            "desc" => "Manage Party Listing"
        ]
    ];
@endphp

@extends('layouts.layout')

@section('content')

    <section class="home_page module_holder">
        <div class="holder_heading">
            Modules
        </div>

        <div class="holder_board">
            
            @foreach ($modules as $module)
                <x-module-box :module="$module"/>
            @endforeach

        </div>
    </section>

@endsection