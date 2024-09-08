@extends("layouts.layout")

@section("content")

    <x-search title="Search Lot..."/>

    <div class="filters mb-2">
        <x-page-heading title="Lots" addUrl="lot.add" :filter='["view" => "lot.filter", "parties" => $parties]'/>
        @include("partials.flash_messages")
    </div>

    <section class="item_listings">
        @include("lot.listing")
    </section>

@endsection