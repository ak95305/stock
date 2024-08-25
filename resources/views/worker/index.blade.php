@extends("layouts.layout")

@section("content")

    <div class="filters px-3 mb-2">
        <h2 class="text-center">Worker</h2>

        @include("worker.filter")
    </div>

    <div class="px-3 text-end">
        <a href={{ route("worker.add") }} class="btn btn-success btn-sm">Add Worker</a>
    </div>
    <section class="table_listing px-3">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Worker Type</th>
                        <th>Phone Number</th>
                        <th>Created</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($listing as $value)
                        <tr>
                            <td>{{ @$value->id }}</td>
                            <td>{{ @$value->first_name }}</td>
                            <td>{{ @$value->last_name }}</td>
                            <td>{{ @$value->workerType->title }}</td>
                            <td>{{ @$value->phonenumber }}</td>
                            <td>{{ @$value->created_at }}</td>
                            <td>
                                <form action={{ route("worker.statusChange", ["id" => @$value->id, "status" => @$value->status ? "0" : "1"]) }} method="post">
                                    @csrf
                                    <button class="btn" type="submit"><small>{{ @$value->status ? "🟢" : "🔴" }}</small></button>
                                </form>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href={{ route("worker.edit", ["id" => @$value->id]) }} class="btn btn-success btn-sm"><small>EDIT</small></a>
                                    <form action={{ route("worker.delete", ["id" => @$value->id]) }} method="post">
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
    </section>

@endsection