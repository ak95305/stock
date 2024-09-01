@php
    $modules = [
        [
            "url" => route("lot.index"),
            "title" => "Lot",
            "desc" => "Manage Lot Listing and Assing Lots",
            "icon" => "layers"
        ],
        [
            "url" => route("worker.index"),
            "title" => "Worker",
            "desc" => "Manage Worker Listing",
            "icon" => "user"
        ],
        [
            "url" => route("workerType.index"),
            "title" => "Worker Type",
            "desc" => "Manage Worker Type Listing",
            "icon" => "users"

        ],
        [
            "url" => route("party.index"),
            "title" => "Party",
            "desc" => "Manage Party Listing",
            "icon" => "user"
        ]
    ];
@endphp

@extends('layouts.layout')

@section('content')

    <section class="home_page module_holder">
        <x-page-heading title="Modules" filter="{{ false }}"/>

        <div class="holder_board">
            
            @foreach ($modules as $module)
                <x-module-box :module="$module"/>
            @endforeach

        </div>
    </section>

@endsection