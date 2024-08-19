@extends('layouts.layout')

@section('content')

    <section class="lot_add_form px-3 old_form">
        <h2 class="text-center">Edit Party</h2>
        
        <div class="flash_messages">
            @include("partials.flash_messages")
        </div>

        <form action={{ route("party.edit", ["id" => $record->id]) }} method="POST" class="mt-3">
            @csrf()
            <div class="form_group mb-2">
                <div class="row">
                    <div class="col-4">
                        <label class="w-100 text-end" for="first_name">First Name</label>
                    </div>
                    <div class="col-8">
                        <input class="w-100" type="text" name="first_name" id="first_name" value="{{ old("first_name", @$record->first_name) }}">
                        <span class="text-danger">
                            @error('first_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
            </div>
            <div class="form_group mb-2">
                <div class="row">
                    <div class="col-4">
                        <label class="w-100 text-end" for="last_name">Last Name</label>
                    </div>
                    <div class="col-8">
                        <input class="w-100" type="text" name="last_name" id="last_name" value="{{ old("last_name", @$record->last_name) }}">
                        <span class="text-danger">
                            @error('last_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
            </div>
            <div class="form_group mb-2">
                <div class="row">
                    <div class="col-4">
                        <label class="w-100 text-end" for="company_name">Company Name</label>
                    </div>
                    <div class="col-8">
                        <input class="w-100" type="text" name="company_name" id="company_name" value="{{ old("company_name", @$record->company_name) }}">
                        <span class="text-danger">
                            @error('company_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-end">
                <a href={{ route("party.index") }} class="btn btn-success btn-sm">Go to Listing</a>
                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
            </div>
        </form>
    </section>
    
@endsection
