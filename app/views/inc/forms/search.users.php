<form class="d-flex" method="post" action="<?= URLROOT . 'flight/getUsers' ?>">
    <select name="select" class="form-select me-2" aria-label="example">
        <option value="1" selected>All</option>
        <option value="nic">NIC</option>
        <option value="lastName">Last Name</option>
        <option value="phone">Phone</option>
    </select>
    <input name="value" class="form-control me-2 w-auto" type="search" placeholder="Search flights" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
</form>