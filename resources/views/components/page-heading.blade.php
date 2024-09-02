<div class="holder_heading">
    <div class="heading_title">
        {{ $title }}
    </div>
    @if(isset($filter) && $filter)
        <div class="sorts_filters">
            <span class="filter_icon" role="button" data-bs-toggle="modal" data-bs-target="#filterModal">
                <i data-feather="filter"></i>
            </span>

            <span class="sort_icon dropdown-toggle {{ request()->sort == "lots.date" ? "active" : "" }}" data-bs-toggle="dropdown" role="button">
                <i data-feather="code"></i>
            </span>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route("lot.index", ["sort" => "lots.date", "direction" => "desc"]) }}"><i data-feather="arrow-down"></i>New to Old</a></li>
                <li><a class="dropdown-item" href="{{ route("lot.index", ["sort" => "lots.date", "direction" => "asc"]) }}"><i data-feather="arrow-up"></i> Old to New</a></li>
            </ul>
        </div>
    @endif
</div>

@if(isset($filter) && $filter)
<div class="modal fade filter_modal" id="filterModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="holder_heading">
                <div class="heading_title">
                    Filters
                </div>
            </div>

            <form action="" method="GET">
                <div class="filter_holder">
                    <div class="filter_box">
                        <label class="form-label">From Date</label>
                        <input type="date" class="form-control" name="from_date" value="{{ request()->from_date }}" id="">
                    </div>
                    <div class="filter_box">
                        <label class="form-label">To Date</label>
                        <input type="date" class="form-control" name="to_date" value="{{ request()->to_date }}" id="">
                    </div>
                </div>
    
                <div class="filter_box">
                    <label class="form-label">Party</label>
                    <select class="form-control select2" id="id_label_multiple" multiple="multiple">
                        <option value="">AAA</option>
                        <option value="">AAA</option>
                        <option value="">AAA</option>
                        <option value="">AAA</option>
                    </select>
                </div>
    
                <div class="filter_actions">
                    <a href="{{ route("lot.index") }}" type="button" class="btn btn-danger btn-sm">Reset</a>
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif