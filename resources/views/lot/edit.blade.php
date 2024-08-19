@extends('layouts.layout')

@section('content')

    <section class="lot_add_form px-3 old_form">
        <h2 class="text-center">Edit Lot</h2>
        
        <div class="flash_messages">
            @include("partials.flash_messages")
        </div>

        <form action={{ route("lot.edit", ["id" => $record->id]) }} method="POST" class="mt-3">
            @csrf()
            <div class="form_group mb-2">
                <div class="row">
                    <div class="col-4">
                        <label class="w-100 text-end" for="lot_no">Lot No.</label>
                    </div>
                    <div class="col-8">
                        <input class="w-100" type="text" name="lot_no" id="lot_no" value="{{ old("lot_no", @$record->lot_no) }}">
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
                            <option value="1" {{ old("party_id", @$record->party_id) == 1 ? "selected" : "" }} >1</option>
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
                        <label class="w-100 text-end" for="rate">Rate</label>
                    </div>
                    <div class="col-8">
                        <input class="w-100" type="number" name="rate" id="rate" value="{{ old("rate", $record->rate) }}>
  "                  </div>
                </div>
            </div>
            <div class="form_group mb-2">
                <div class="row">
                    <div class="col-4">
                        <label class="w-100 text-end" for="date">Date</label>
                    </div>
                    <div class="col-8">
                        <input class="w-100" type="date" name="date" id="date" value="{{ old("date", $record->date) }}>
  "                  </div>
                </div>
            </div>

            <div class="mt-4 text-end">
                <a href={{ route("lot.index") }} class="btn btn-success btn-sm">Go to Listing</a>
                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
            </div>
        </form>
    </section>
    
@endsection
