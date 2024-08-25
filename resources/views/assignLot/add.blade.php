@extends('layouts.layout')

@section('content')

    <section class="assign_lot_form px-3 old_form">
        <h2 class="text-center">Assign Lot</h2>
        
        <div class="flash_messages">
            @include("partials.flash_messages")
        </div>

        <form action={{ route("assignLot.add") }} method="POST" class="mt-3">
            @csrf()
            <div class="form_group mb-2">
                <div class="row">
                    <div class="col-4">
                        <label class="w-100 text-end" for="lot_id">Lot</label>
                    </div>
                    <div class="col-8">
                        <select class="w-100" name="lot_id" id="lot_id" data-url="{{ route("assignLot.getLotAssignInfo") }}">
                            <option value="">Select</option>
                            @foreach ($lots as $lot)
                                <option value="{{ $lot["id"] }}" {{ old("lot_id") == $lot["id"] ? "selected" : "" }}>{{ $lot["lot_no"] . " (" . @$lot["pcs"] . "pcs)" }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('lot_id')
                                {{ $message }}
                            @enderror
                        </span>
                        <div class="lot_data" id="lot_data" style="display: none">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tailor</th>
                                        <th>Pcs</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="form_group mb-2">
                <div class="row">
                    <div class="col-4">
                        <label class="w-100 text-end" for="worker_id">Worker</label>
                    </div>
                    <div class="col-8">
                        <select class="w-100" name="worker_id" id="worker_id">
                            <option value="">Select</option>
                            @foreach ($workers as $worker)
                                <option value="{{ $worker["id"] }}" {{ old("worker_id") == $worker["id"] ? "selected" : "" }}>{{ @$worker["first_name"] . " (" . @$worker['workerType']['title'] . ")" }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('worker_id')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
            </div>
            <div class="form_group mb-2">
                <div class="row">
                    <div class="col-4">
                        <label class="w-100 text-end" for="rate">Rate</label>
                    </div>
                    <div class="col-8">
                        <input class="w-100" type="text" name="rate" id="rate" value="{{ old("rate") }}">
                        <span class="text-danger">
                            @error('rate')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
            </div>
            <div class="form_group mb-2">
                <div class="row">
                    <div class="col-4">
                        <label class="w-100 text-end" for="assign_pcs">Assign Pcs</label>
                    </div>
                    <div class="col-8">
                        <input class="w-100" type="text" name="assign_pcs" id="assign_pcs" value="{{ old("assign_pcs") }}">
                        <div class="btn btn-sm btn-primary mt-1 add_all_btn disabled" role="button">Add All</div>
                        <span class="text-danger">
                            @error('assign_pcs')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
            </div>
            <div class="form_group mb-2">
                <div class="row">
                    <div class="col-4">
                        <label class="w-100 text-end" for="assign_date">Assign Date</label>
                    </div>
                    <div class="col-8">
                        <input class="w-100" type="date" name="assign_date" id="assign_date" value="{{ old("assign_date") }}">
                        <span class="text-danger">
                            @error('assign_date')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-end">
                {{-- <a href={{ route("assignLot.index") }} class="btn btn-success btn-sm">Go to Listing</a> --}}
                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
            </div>
        </form>
    </section>
    
@endsection
