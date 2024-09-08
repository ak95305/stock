<div class="search_input">
    <input type="text" class="form-control" id="search_box" value="{{ request()->search ? request()->search : "" }}" placeholder="{{ $title }}" data-url="{{ route("lot.index") }}">
  </div>