<div class="holder_heading">
    <div class="heading_title">
        {{ $title }}
    </div>
    @if(isset($filter) && $filter)
    <div class="sorts_filters">
        <span class="filter_icon" role="button">
            <i data-feather="filter"></i>
        </span>
        <span class="sort_icon" role="button">
            <i data-feather="code"></i>
        </span>
    </div>
    @endif
</div>