<div class="holder_heading">
    <div class="heading_title">
        {{ $title }}
    </div>
    @if(isset($filter) && $filter)
        <div class="sorts_filters">
            <span class="filter_icon" role="button" data-bs-toggle="modal" data-bs-target="#filterModal">
                <i data-feather="filter"></i>
            </span>

            <span class="sort_icon dropdown-toggle" data-bs-toggle="dropdown" role="button">
                <i data-feather="code"></i>
            </span>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#"><i data-feather="arrow-down"></i>New to Old</a></li>
                <li><a class="dropdown-item" href="#"><i data-feather="arrow-up"></i> Old to New</a></li>
            </ul>
        </div>
    @endif
</div>


<div class="modal fade" id="filterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="holder_heading">
                <div class="heading_title">
                    Filters
                </div>
            </div>
            <div class="fitler_box">
                <label class="form-label">Date</label>

                <div class="input_box">
                    <div class="date_input">
                        <input type="date" class="form-control" id="">
                    </div>
                    
                    <div class="date_input">
                        <input type="date" class="form-control" id="">
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Understood</button>
        </div>
    </div>
</div>
