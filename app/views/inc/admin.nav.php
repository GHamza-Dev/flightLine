<nav class="navbar navbar-expand-lg navbar-light bg-light my-4">
  <div class="container-fluid">
  <a class="navbar-brand" aria-current="page" href="#">
      <img width="100" height="" src="<?= URLROOT.'/public/images/logo/logo.png'?>" alt="jhzg">
    </a>
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
              <li><a class="dropdown-item nav-link" aria-current="page" href="<?= URLROOT.'flight' ?>">All Flights</a></li>
              <li><a class="dropdown-item nav-link" aria-current="page" href="<?= URLROOT.'flight' ?>">Flights</a></li>
            </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URLROOT.'flight/addFlight' ?>">Add flight</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URLROOT.'' ?>">Users</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>