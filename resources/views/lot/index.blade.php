@extends("layouts.layout")

@section("content")

    <div class="filters px-3 mb-2">
        <h2 class="text-center">Lots</h2>

        Filters: <input type="checkbox" id="filter_checkbox">
        <form action={{ route("lot.index") }} method="get" class="filters_form">
            <div class="form_group mb-2">
                <label for="search">Search</label>
                <input type="text" id="search" name="search" value={{ isset($_GET['search']) ? $_GET['search'] : "" }}>
            </div>
            <div class="form_group mb-2">
                <label for="from_date">From Date</label>
                <input type="date" id="from_date" name="from_date" value={{ isset($_GET['from_date']) ? $_GET['from_date'] : "" }}>
            </div>
            <div class="form_group mb-2">
                <label for="to_date">To Date</label>
                <input type="date" id="to_date" name="to_date" value={{ isset($_GET['to_date']) ? $_GET['to_date'] : "" }}>
            </div>
            <div class="form_group mb-2">
                <label for="party">Party</label>
                <select name="party" id="party">
                    <option value="">Select</option>
                    <option value="1" {{ isset($_GET['party']) && $_GET['party'] == "1" ? "selected" : "" }}>1asfasdf</option>
                    <option value="2" {{ isset($_GET['party']) && $_GET['party'] == "2" ? "selected" : "" }}>1asdf</option>
                    <option value="3" {{ isset($_GET['party']) && $_GET['party'] == "3" ? "selected" : "" }}>1</option>
                </select>
            </div>
            <button class="btn btn-primary btn-sm mt-2" type="submit"><small>Search</small></button>
        </form>
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
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->lot_no }}</td>
                            <td>{{ $value->party->first_name . " " . $value->party->last_name }} ({{ $value->party->company_name }})</td>
                            <td>{{ $value->rate }}</td>
                            <td>{{ $value->date }}</td>
                            <td>
                                <form action={{ route("lot.statusChange", ["id" => $value->id, "status" => @$value->status ? "0" : "1"]) }} method="post">
                                    @csrf
                                    <button class="btn" type="submit"><small>{{ @$value->status ? "🟢" : "🔴" }}</small></button>
                                </form>
                            </td>
                            <td>
                                <a href={{ route("lot.edit", ["id" => $value->id]) }} class="btn btn-success btn-sm"><small>EDIT</small></a>
                                <form action={{ route("lot.delete", ["id" => $value->id]) }} method="post">
                                    @csrf
                                    <button class="btn btn-danger btn-sm" type="submit" onclick="confirm('Do you want to delete this record?')"><small>DEL</small></button>
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