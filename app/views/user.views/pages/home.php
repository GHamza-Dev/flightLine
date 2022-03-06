<?php require_once VIEWS . '/user.views/inc/header.php' ?>
<header style="height: 600px;background:url(<?= URLROOT . 'public/images/flight-bg.jfif' ?>) no-repeat; background-size:cover;">
  <div class="container h-100 w-100 d-flex justify-content-center align-items-center">
    <form id="search-form" class="mx-auto row row-cols-auto bg-light p-5 rounded" action="<?= URLROOT . 'flight/availableFlights' ?>" method="POST">
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
        <input for="depart" class="p-2 rounded border" type="datetime-local" name="depart">
      </div>
      <div class="d-flex flex-column m-1">
        <label class="mb-1 text-secondary" for="arrival">Arrial</label>
        <input id="arrival" class="p-2 rounded border" type="datetime-local" name="arrival">
      </div>
      <div class="d-flex flex-column justify-content-end m-1">
        <button class="bg-success p-2 text-light border-0 fw-bold rounded">Search | <i class="fa-solid fa-plane-departure"></i></button>
      </div>
    </form>
  </div>
</header>
<div class="container pb-5 mb-5">
  <h2 class="text-secondary fs-3 py-4">Available flights</h2>
  <div class="flights">

  </div>
  
</div>
<script>

  const url = 'http://localhost/flightline/flight/availableFlights';
  const form = document.getElementById('search-form');
  const flights = document.querySelector('.flights');

  async function getFlights() {
    const res = await fetch(url);
    const data = await res.json();
    return data;
  }

  async function searchFlights(formData) {
    const res = await fetch(url, {
      method: 'post',
      body: formData
    });
    const data = await res.json();
    return data;
  }

  function showFlights(element, flights) {
    let html = flights.length < 1 ? `<p class='fs-3 text-info'>No flights accurs!</p>` : ``;
    flights.forEach(flight => {
      html += `
      <div class="bg-light p-3 rounded-3 my-3">
        <div class="row row-cols-md-5 row-cols-2 g-3">
          <div><b class="text-danger">From <i class="fa-solid fa-plane-departure"></i></b>:  ${flight['aFrom']} </div>
          <div><b class="text-danger">To <i class="fa-solid fa-plane-arrival"></i></b>:  ${flight['aTo']} </div>
          <div><b class="text-info">Depart <i class="fa-solid fa-flag-checkered"></i></b>:  ${flight['departTime']} </div>
          <div><b class="text-success">Arrival <i class="fa-solid fa-cannabis"></i></b>:  ${flight['arrivalTime']} </div>
          <form action="<?= URLROOT . 'booking/reserve' ?>" method="POST">
            <input type="hidden" name="flightId" value=" ${flight['flightID']} ">
            <button class="btn btn-dark float-md-end">Book |  ${flight['price']}  <i class="fa-solid fa-dollar-sign"></i></button>
          </form>
        </div>
      </div>`;
    });
    element.innerHTML = html;
  }

  document.addEventListener('DOMContentLoaded', async () => {
    const data = await getFlights()
    showFlights(flights, data);
  });

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    data = await searchFlights(formData);
    showFlights(flights, data);
    window.scrollBy({
      top: window.innerHeight,
      behavior: 'smooth'
    });
  })
</script>
<?php require_once VIEWS . '/user.views/inc/footer.php' ?>