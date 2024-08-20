@extends('layouts.layout')

@section('content')

    <section class="lot_add_form px-3 old_form">
        <h2 class="text-center">Add Lot</h2>
        
        <div class="flash_messages">
            @include("partials.flash_messages")
        </div>

        <form action={{ route("lot.add") }} method="POST" class="mt-3">
            @csrf()
            <div class="form_group mb-2">
                <div class="row">
                    <div class="col-4">
                        <label class="w-100 text-end" for="lot_no">Lot No.</label>
                    </div>
                    <div class="col-8">
                        <input class="w-100" type="text" name="lot_no" id="lot_no" value="{{ old("lot_no") }}">
                        <span class="text-danger">
                            @error('lot_no')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
            </div>
            <div class="form_group mb-2">
                <div class="row">
                    <div class="col-4">
                        <label class="w-100 text-end" for="party_id">Party</label>
                    </div>
                    <div class="col-8">
                        <select class="w-100" name="party_id" id="party_id">
                            <option value="">Select</option>
                            @foreach ($parties as $party)
                                <option value="{{ $party["id"] }}" {{ old("party_id") == $party["id"] ? "selected" : "" }}>{{ $party["first_name"] . " " . @$party["last_name"] }} {{ $party['company_name'] ? "(".@$party['company_name'].")" : "" }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('party_id')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
            </div>
            <div class="form_group mb-2">
                <div class="row">
                    <div class="col-4">
                        <label class="w-100 text-end" for="pcs">Pcs.</label>
                    </div>
                    <div class="col-8">
                        <input class="w-100" type="number" name="pcs" id="pcs" {{ old("pcs") }}>
                    </div>
                </div>
            </div>
            <div class="form_group mb-2">
                <div class="row">
                    <div class="col-4">
                        <label class="w-100 text-end" for="rate">Rate</label>
                    </div>
                    <div class="col-8">
                        <input class="w-100" type="number" name="rate" id="rate" {{ old("rate") }}>
                    </div>
                </div>
            </div>
            <div class="form_group mb-2">
                <div class="row">
                    <div class="col-4">
                        <label class="w-100 text-end" for="info">Additional Info</label>
                    </div>
                    <div class="col-8">
                        <textarea class="w-100" type="text" name="info" id="info">{{ old("info") }}</textarea>
                    </div>
                </div>
            </div>
            <div class="form_group mb-2">
                <div class="row">
                    <div class="col-4">
                        <label class="w-100 text-end" for="date">Date</label>
                    </div>
                    <div class="col-8">
                        <input class="w-100" type="date" name="date" id="date" {{ old("date") }}>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-end">
                <a href={{ route("lot.index") }} class="btn btn-success btn-sm">Go to Listing</a>
                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
            </div>
        </form>
    </section>
    
@endsection
