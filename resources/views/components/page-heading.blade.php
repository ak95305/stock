<div class="holder_heading">
    <div class="heading_title">
        {{ $title }}

        @if($addUrl)
        <a href="{{ route("$addUrl") }}" class="btn btn-primary add_btn">Add</a>
        @endif
    </div>
    
    @if(isset($filter) && $filter)
        @include($filter['view'], ['parties' => $filter['parties']])
    @endif
</div>