Filters: <input type="checkbox" id="filter_checkbox" {{ !empty($_GET) && count($_GET) > 0 ? "checked" : "" }}>

<form action={{ route("workerType.index") }} method="get" class="filters_form">
    <div class="form_group mb-2">
        <label for="search">Search</label>
        <input type="text" id="search" name="search" value={{ isset($_GET['search']) ? $_GET['search'] : "" }}>
    </div>
    <div class="form_group mb-2">
        <label for="from_date">From Date</label>
        <input type="date" id="from_date" name="from_date" value={{ isset($_GET['from_date']) ? $_GET['from_date'] : "" }}>
    </div>
    <div class="form_group mb-2">
        <label for="to_date">To Date</label>
        <input type="date" id="to_date" name="to_date" value={{ isset($_GET['to_date']) ? $_GET['to_date'] : "" }}>
    </div>
    <a href="{{ route("workerType.index") }}" class="btn btn-danger btn-sm mt-2">Reset</a>
    <button class="btn btn-primary btn-sm mt-2" type="submit"><small>Search</small></button>
</form>