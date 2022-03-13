<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" aria-current="page" href="<?= URLROOT.'flight' ?>">
      <img width="100" height="" src="<?= URLROOT . '/public/images/logo/default-monochrome-white.svg' ?>" alt="jhzg">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= URLROOT.'flight' ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URLROOT.'booking/mybookings' ?>">Bookings</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Pricing</a>
        </li>
      </ul>
      <?php if (auth()) : ?>
        <a href="<?= URLROOT . 'user/logout' ?>" class="text-white text-decoration-none">
          <span class="text-decoration-underline me-1"><?= ucwords(username()) ?></span>
          <i class="fa-solid fa-right-from-bracket border border-2 border-secondary p-2 rounded-circle text-secondary"></i>
        </a>
      <?php else : ?>
        <div class="d-flex">
          <a class="text-white p-2 border rounded text-decoration-none" href="<?= URLROOT . 'user/login' ?>">Login <i class="fa-solid fa-arrow-right-to-bracket"></i></a>
          <span class="text-white mx-2 py-2"> | </span>
          <a class="text-white p-2 border  rounded text-decoration-none" href="<?= URLROOT . 'user/register' ?>">Register <i class="fa-solid fa-user-plus"></i></a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</nav>