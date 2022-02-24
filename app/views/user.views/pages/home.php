<?php require_once VIEWS . '/user.views/inc/header.php' ?>
<header style="height: 600px;background:url(<?= URLROOT . 'public/images/flight-bg.jfif' ?>) no-repeat; background-size:cover;">
  <div class="container h-100 w-100 d-flex justify-content-center align-items-center">
    <form class="mx-auto row row-cols-auto bg-light p-5 rounded" action="<?= URLROOT . 'flight/availableFlights' ?>" method="POST">
      <div class="d-flex flex-column m-1">
        <label class="mb-1 text-secondary" for="from">From</label>
        <input id="from" class="p-2 rounded border" type="text" name="from" placeholder="From">
      </div>
      <div class="d-flex flex-column m-1">
        <label class="mb-1 text-secondary" for="to">Destination</label>
        <input id="to" class="p-2 rounded border" type="text" name="to" placeholder="To">
      </div>
      <div class="d-flex flex-column m-1">
        <label class="mb-1 text-secondary" for="depart">Depart</label>
        <input for="depart" class="p-2 rounded border" type="datetime-local" name="Depart">
      </div>
      <div class="d-flex flex-column m-1">
        <label class="mb-1 text-secondary" for="arrival">Arrial</label>
        <input id="arrival" class="p-2 rounded border" type="datetime-local" name="Arrival">
      </div>
      <div class="d-flex flex-column justify-content-end m-1">
        <button class="bg-success p-2 text-light border-0 fw-bold rounded">Search | <i class="fa-solid fa-plane-departure"></i></button>
      </div>
    </form>
  </div>
</header>
<div class="container pb-5 mb-5">
  <h2 class="text-secondary fs-3 py-4">Available flights</h2>
  <?php foreach($data['avFlights'] as $flight): ?>
    <div class="bg-light p-3 rounded-3 my-3">
      <div class="row row-cols-md-5 row-cols-2 g-3">
        <div><b class="text-danger">From <i class="fa-solid fa-plane-departure"></i></b>: <?= $flight['aFrom'] ?></div>
        <div><b class="text-danger">To <i class="fa-solid fa-plane-arrival"></i></b>: <?= $flight['aTo'] ?></div>
        <div><b class="text-info">Depart <i class="fa-solid fa-flag-checkered"></i></b>: <?= $flight['departTime'] ?></div>
        <div><b class="text-success">Arrival <i class="fa-solid fa-cannabis"></i></b>: <?= $flight['arrivalTime'] ?></div>
        <form action="<?= URLROOT.'booking/reserve' ?>" method="POST">
          <input type="hidden" name="flightId" value="<?= $flight['flightID'] ?>">
          <button class="btn btn-dark float-md-end">Book | <?= $flight['price'] ?> <i class="fa-solid fa-dollar-sign"></i></button>
        </form>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<?php require_once VIEWS . '/user.views/inc/footer.php' ?>