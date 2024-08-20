@extends('layouts.layout')

@section('content')

    <section class="lot_add_form px-3 old_form">
        <h2 class="text-center">Add Worker Type</h2>
        
        <div class="flash_messages">
            @include("partials.flash_messages")
        </div>

        <form action={{ route("workerType.add") }} method="POST" class="mt-3">
            @csrf()
            <div class="form_group mb-2">
                <div class="row">
                    <div class="col-4">
                        <label class="w-100 text-end" for="title">Title</label>
                    </div>
                    <div class="col-8">
                        <input class="w-100" type="text" name="title" id="title" value="{{ old("title") }}">
                        <span class="text-danger">
                            @error('title')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-end">
                <a href={{ route("workerType.index") }} class="btn btn-success btn-sm">Go to Listing</a>
                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
            </div>
        </form>
    </section>
    
@endsection
