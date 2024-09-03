<div class="holder_heading">
    <div class="heading_title">
        {{ $title }}
    </div>
    
    @if(isset($filter) && $filter)
        @include($filter['view'], ['parties' => $filter['parties']])
    @endif
</div>