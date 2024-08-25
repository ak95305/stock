@extends('layouts.layout')

@section('content')

    <section class="assign_lot_form px-3 old_form">
        <h2 class="text-center">Assign Lot</h2>
        
        <div class="flash_messages">
            @include("partials.flash_messages")
        </div>

        <form action={{ route("assignLot.edit", ["lotId" => $lotId]) }} method="POST" class="mt-3">
            @csrf()
            <div class="form_group mb-2">
                <div class="row">
                    <div class="col-4">
                        <label class="w-100 text-end" for="lot_id">Lot</label>
                    </div>
                    <div class="col-8">
                        <select disabled class="w-100" name="lot_id" id="lot_id" data-url="{{ route("assignLot.getLotAssignInfo") }}">
                            <option value="">Select</option>
                            @foreach ($lots as $lot)
                                <option value="{{ $lot["id"] }}" {{ old("lot_id", $lotId) == $lot["id"] ? "selected" : "" }}>{{ $lot["lot_no"] . " (" . @$lot["pcs"] . "pcs)" }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('lot_id')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
                <div class="lot_data table-responsive py-5" id="lot_data" data-lot-data="{{ $assignLotInfo }}">
                    <table class="table">
                        <tr>
                            <th>Date</th>
                            <th>Tailor</th>
                            <th>rate</th>
                            <th>Pcs</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($assignLotInfo->worker as $key => $value)
                            <tr>
                                <td><input type="date" name="{{ "assign_lot[$value->id][assign_date]" }}" value="{{ $value->assign_date }}"></td>
                                <td>{{ $value->first_name }}</td>
                                <td><input class="w-50" type="text" name="{{ "assign_lot[$value->id][rate]" }}" value="{{ $value->rate }}"></td>
                                <td><input class="w-50 assign_pcs" type="text" name="{{ "assign_lot[$value->id][assign_pcs]" }}" value="{{ $value->assign_pcs }}"></td>
                                <td><span class="delete_assign_worker" role="button">❌</span></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            <div class="mt-4 text-end">
                <a href={{ route("assignLot.add") }} class="btn btn-success btn-sm">Assign Tailor</a>
                <label class="error form_error text-danger"></label>
                @if(count($assignLotInfo->worker) > 0)
                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                @endif
            </div>
        </form>
    </section>
    
@endsection
