@extends("layouts.layout")

@section("content")

    <div class="filters px-3 mb-2">
        <h2 class="text-center">Lots</h2>
        @include("partials.flash_messages")
        
        @include("lot.filter")
    </div>

    <div class="px-3 text-end">
        <a href={{ route("lot.add") }} class="btn btn-success btn-sm">Add Lot</a>
    </div>
    <section class="table_listing px-3">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Lot No.</th>
                        <th>Party</th>
                        <th>Rate</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($listing as $value)
                        <tr>
                            <td>{{ @$value->id }}</td>
                            <td>{{ @$value->lot_no }}</td>
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
                                <a href={{ route("lot.edit", ["id" => @$value->id]) }} class="btn btn-success btn-sm"><small>EDIT</small></a>
                                <form action={{ route("lot.delete", ["id" => @$value->id]) }} method="post">
                                    @csrf
                                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Do you want to delete this record?')"><small>DEL</small></button>
                                </form>
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
    </section>

@endsection