@if (Session::has('error'))
    <div class="text-center py-2 text-danger">
        {{ Session::get('error') }}
    </div>
@endif
@if (Session::has('success'))
    <div class="text-center py-2 text-success">
        {{ Session::get('success') }}
    </div>
@endif
