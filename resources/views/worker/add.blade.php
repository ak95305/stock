@extends('layouts.layout')

@section('content')

    <section class="lot_add_form px-3 old_form">
        <h2 class="text-center">Add Worker</h2>
        
        <div class="flash_messages">
            @include("partials.flash_messages")
        </div>

        <form action={{ route("worker.add") }} method="POST" class="mt-3">
            @csrf()
            <div class="form_group mb-2">
                <div class="row">
                    <div class="col-4">
                        <label class="w-100 text-end" for="first_name">First Name</label>
                    </div>
                    <div class="col-8">
                        <input class="w-100" type="text" name="first_name" id="first_name" value="{{ old("first_name") }}">
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
                        <input class="w-100" type="text" name="last_name" id="last_name" value="{{ old("last_name") }}">
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
                        <label class="w-100 text-end" for="worker_type_id">Worker Type</label>
                    </div>
                    <div class="col-8">
                        <select class="w-100" name="worker_type_id" id="worker_type_id">
                            <option value="">Select</option>
                            @foreach ($workerTypes as $type)
                                <option value="{{ $type["id"] }}" {{ old("worker_type_id") == $type["id"] ? "selected" : "" }}>{{ @$type["title"] }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('worker_type_id')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
            </div>
            <div class="form_group mb-2">
                <div class="row">
                    <div class="col-4">
                        <label class="w-100 text-end" for="phonenumber">Phone Number</label>
                    </div>
                    <div class="col-8">
                        <input class="w-100" type="text" name="phonenumber" id="phonenumber" value="{{ old("phonenumber") }}">
                        <span class="text-danger">
                            @error('phonenumber')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-end">
                <a href={{ route("worker.index") }} class="btn btn-success btn-sm">Go to Listing</a>
                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
            </div>
        </form>
    </section>
    
@endsection
