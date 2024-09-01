<div class="listing_item">
    <h2 class="item_header">
        <button class="accordion-button header_button" type="button" data-bs-toggle="collapse"
            data-bs-target="#item_{{ $key }}" aria-expanded="true" aria-controls="item_{{ $key }}">
            <div class="header_title">
                <h4><span class="head">Lot No.:</span> <span class="value">{{ @$item['lot_no'] }}</span></h4>
                <p>{{ @$item['pcs'] }} pcs.</p>
            </div>
        </button>
        <div class="header_actions">
            <div class="action_status form-check form-switch">
                <input type="checkbox" class="status_input form-check-input">
            </div>
            <div class="dropdown">
                <div class="action_icon btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                </div>
                <ul class="action_menu dropdown-menu">
                    <li><a class="dropdown-item" href="#"><i data-feather="info"></i> More Info</a></a></li>
                    <li><a class="dropdown-item" href="#"><i data-feather="edit-3"></i> Edit</a></a></li>
                    <li><a class="dropdown-item" href="#"><i data-feather="trash"></i> Delete</a></a></li>
                </ul>
            </div>
        </div>
    </h2>
    <div id="item_{{ $key }}" class="item_body collapse" data-bs-parent="#listingItems">
        <div class="body_content">
            <div class="content_item">
                <div class="content_item_head">Tailor</div>
                <div class="content_item_value">Name Here</div>
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
                <a class="btn btn-primary btn-sm">
                    More Info
                </a>
            </div>
        </div>
    </div>
</div>