@extends("layouts.layout")

@section("content")

    <x-search title="Search Lot..."/>

    <div class="filters mb-2">
        <x-page-heading title="Lots" :filter='["view" => "lot.filter", "parties" => $parties]'/>
        @include("partials.flash_messages")
        
        {{-- @include("lot.filter") --}}
    </div>

    {{-- <div class="px-3 text-end">
        <a href={{ route("lot.add") }} class="btn btn-success btn-sm">Add Lot</a>
    </div> --}}
    {{-- <section class="table_listing px-3">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="min-width: 100px">#</th>
                        <th style="min-width: 100px">Lot No.</th>
                        <th style="min-width: 100px">Assign Info.</th>
                        <th style="min-width: 100px">Party</th>
                        <th style="min-width: 100px">Rate</th>
                        <th style="min-width: 100px">Date</th>
                        <th style="min-width: 100px">Status</th>
                        <th style="min-width: 100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($listing as $value)
                        <tr>
                            <td>{{ @$value->id }}</td>
                            <td>{{ @$value->lot_no }}</td>
                            <td>
                                <a href={{ route("assignLot.edit", ["lotId" => @$value->id]) }} class="btn btn-primary btn-sm"><small>Assign Info</small></a>
                            </td>
                            @if(isset($value->party->first_name) && $value->party->first_name)
                            <td>{{ @$value->party->first_name . " " . @$value->party->last_name }} ({{ @$value->party->company_name }})</td>
                            @else
                            <td>--</td>
                            @endif
                            <td>{{ @$value->rate }}</td>
                            <td>{{ @$value->date }}</td>
                            <td>
                                <form action={{ route("lot.statusChange", ["id" => @$value->id, "status" => @$value->status ? "0" : "1"]) }} method="post">
                                    @csrf
                                    <button class="btn" type="submit"><small>{{ @$value->status ? "🟢" : "🔴" }}</small></button>
                                </form>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href={{ route("lot.edit", ["id" => @$value->id]) }} class="btn btn-success btn-sm"><small>EDIT</small></a>
                                    <form action={{ route("lot.delete", ["id" => @$value->id]) }} method="post">
                                        @csrf
                                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Do you want to delete this record?')"><small>DEL</small></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7"> No Data Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section> --}}

    <section class="item_listings">
        <x-listing :listing="$listing" itemComponent="lot-listing-item"/>
    </section>

@endsection