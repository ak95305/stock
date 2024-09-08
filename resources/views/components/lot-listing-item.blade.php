<div class="listing_item">
    <h2 class="item_header">
        <button class="accordion-button header_button" type="button" data-bs-toggle="collapse"
            data-bs-target="#item_{{ $key }}" aria-expanded="true" aria-controls="item_{{ $key }}">
            <div class="header_title">
                <h4><span class="head">Lot No.:</span> <span class="value">{{ @$item['lot_no'] }}</span> <span class="value small">({{ @$item['pcs'] }} pcs.)</span></h4>
                <p>{{ @$item['info'] }}</p>
            </div>
        </button>
        <div class="header_actions">
            <div class="action_status form-check form-switch">
                <input type="checkbox" class="status_input form-check-input change_status" {{ @$item['status'] ? "checked" : "" }} data-url="{{ route("lot.changeStatus", ["id" => @$item['id']]) }}">
            </div>
            <div class="dropdown">
                <div class="action_icon btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                </div>
                <ul class="action_menu dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route("assignLot.edit", ["lotId" => @$item['id']]) }}"><i data-feather="info"></i> More Info</a></a></li>
                    <li><a class="dropdown-item" href="{{ route("lot.edit", ["id" => @$item['id']]) }}"><i data-feather="edit-3"></i> Edit</a></a></li>
                    <li><a class="dropdown-item" href="{{ route("lot.delete", ["id" => @$item['id']]) }}" onclick="return confirm('You Sure?')"><i data-feather="trash"></i> Delete</a></a></li>
                </ul>
            </div>
        </div>
    </h2>
    <div id="item_{{ $key }}" class="item_body collapse {{ request()->search != "" || request()->search == "0" ? "show" : "" }}" data-bs-parent="#listingItems">
        <div class="body_content">
            <div class="content_item">
                <div class="content_item_head">Tailor</div>
                <div class="content_item_value">{{ implode(", ", array_column(@$item->worker->toArray(), "first_name")) }}</div>
            </div>
            <div class="content_item">
                <div class="content_item_head">Party</div>
                <div class="content_item_value">{{ @$item->party->first_name . " " . @$item->party->last_name }} ({{ @$item->party->company_name }})</div>
            </div>
            <div class="content_item">
                <div class="content_item_head">Rate</div>
                <div class="content_item_value">{{ @$item->rate }}/-</div>
            </div>
            <div class="content_item">
                <div class="content_item_head">Date</div>
                <div class="content_item_value">{{ date("M d, Y", strtotime(@$item->date)) }}</div>
            </div>
            <div class="content_item">
                <a href="{{ route("assignLot.edit", ["lotId" => @$item['id']]) }}" class="btn btn-primary btn-sm">
                    More Info
                </a>
            </div>
        </div>
    </div>
</div>