<div class="accordion" id="listingItems">

    @foreach ($listing as $item)
        <x-dynamic-component :component="$itemComponent" key="{{ $loop->iteration }}" :item="$item"/>
    @endforeach

</div>