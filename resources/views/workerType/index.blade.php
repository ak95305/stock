@extends("layouts.layout")

@section("content")

    <div class="filters px-3 mb-2">
        <h2 class="text-center">Worker Type</h2>

        @include("workerType.filter")
    </div>

    <div class="px-3 text-end">
        <a href={{ route("workerType.add") }} class="btn btn-success btn-sm">Add Worker Type</a>
    </div>
    <section class="table_listing px-3">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Created</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($listing as $value)
                        <tr>
                            <td>{{ @$value->id }}</td>
                            <td>{{ @$value->title }}</td>
                            <td>{{ @$value->created_at }}</td>
                            <td>
                                <form action={{ route("workerType.statusChange", ["id" => @$value->id, "status" => @$value->status ? "0" : "1"]) }} method="post">
                                    @csrf
                                    <button class="btn" type="submit"><small>{{ @$value->status ? "🟢" : "🔴" }}</small></button>
                                </form>
                            </td>
                            <td>
                                <a href={{ route("workerType.edit", ["id" => @$value->id]) }} class="btn btn-success btn-sm"><small>EDIT</small></a>
                                <form action={{ route("workerType.delete", ["id" => @$value->id]) }} method="post">
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