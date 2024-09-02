<div class="accordion" id="listingItems">

    @forelse ($listing as $item)
        <x-dynamic-component :component="$itemComponent" key="{{ $loop->iteration }}" :item="$item"/>
    @empty
        <div class="empty_list">
            No Data Found!
        </div>
    @endforelse

</div>