<nav class="navbar navbar-expand-lg navbar-light bg-light my-4">
  <div class="container-fluid">
    <div class="dropdown">
      <a class="navbar-brand" id="admin-options" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img width="100" height="" src="<?= URLROOT . '/public/images/logo/default-monochrome.svg' ?>" alt="jhzg">
      </a>
      <ul class="dropdown-menu" aria-labelledby="admin-options">
        <li><a class="dropdown-item nav-link" href="<?= URLROOT . 'flight' ?>">User View</a></li>
        <li><a class="dropdown-item nav-link" href="<?= URLROOT . 'user/logout' ?>">Logout</a></li>
      </ul>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Flights
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item nav-link"  href="<?= URLROOT . 'flight/getFlights' ?>">All Flights</a></li>
            <li><a class="dropdown-item nav-link"  href="<?= URLROOT . 'flight/getNextFlights' ?>">Next Flights</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URLROOT . 'flight/addFlight' ?>">Add flight</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URLROOT . 'booking/bookings' ?>">Bookings</a>
        </li>
      </ul>
      <?php
      $path = isset($data['search-form']) ? $data['search-form'] : VIEWS . '/inc/forms/search.next.php';
      require_once $path;
      ?>
    </div>
  </div>
</nav>