<?php require_once VIEWS . '/user.views/inc/header.php' ?>
<?php

// dump($data);
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">FlightLine</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Bookings</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
      </ul>
      <div class="d-flex">
        <a class="text-white p-2 border rounded text-decoration-none" href="#">Login <i class="fa-solid fa-arrow-right-to-bracket"></i></a> <span class="text-white mx-2 py-2"> | </span> <a class="text-white p-2 border  rounded text-decoration-none" href="#">Register <i class="fa-solid fa-user-plus"></i></a>
      </div>
    </div>
  </div>
</nav>
<div class="container">
  <h2 class="text-secondary my-3">Reserve flight</h2>
</div>
<div class="alert-err alert alert-danger alert-dismissible fade position-fixed top-0 start-0 w-100" style="z-index: 9;" role="alert">
    There is <strong>No enough</strong> seats in this flight
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<div class="container py-2 position-relative">
  <form id="reservation-form" action="<?= URLROOT.'booking/reserve' ?>" method="post">
    <div class="passangers">
      <div class="passanger container border border-info py-2">
        <p class="fs-3 text-info">Passanger n°1</p>
        <div class="row row-cols-md-3">
          <div class="mb-3">
            <label for="fname1" class="form-label">First name</label>
            <input type="text" name='fname[]' class="form-control" id="fname1" placeholder="Passanger first name" required>
          </div>
          <div class="mb-3">
            <label for="lname1" class="form-label">Last name</label>
            <input type="text" name='lname[]' class="form-control" id="lname1" placeholder="Passanger last name" required>
          </div>
          <div class="mb-3">
            <label for="date1" class="form-label">Birth Day</label>
            <input type="date" name='date[]' class="form-control" id="date1" required>
          </div>
        </div>
      </div>
    </div>
    <input type="hidden" name="reserveFlight" value="<?= $data['flightId'] ?>">
    <input type="hidden" name="reserveUser" value="<?= $data['userId'] ?>">
    <div class="d-flex align-items-center justify-content-end">
      <button class="add-form btn btn-warning me-3"><i class="fa-solid fa-user-plus"></i></button>
      <button type="submit" name="book" value="1" class="my-3 btn btn-success float-end px-3">Submit</button>
    </div>
  </form>
</div>

<script>
    let nbrOfAvSeats = <?= $data['nbrOfAvSeats'] ?>;
    let nbrOfPassangers = 2;

    const addFormBtn = document.querySelector('.add-form');
    const form = document.querySelector('#reservation-form');
    const passangersBox = document.querySelector('.passangers');
    const alertErr = document.querySelector('.alert-err');

    addFormBtn.addEventListener('click',(e)=>{
      e.preventDefault();
      if (nbrOfAvSeats < nbrOfPassangers) {
          alertErr.classList.add('show');
          return;
      }
      createForm();
    });

    function createForm(){
      let psger = document.createElement('div');
      psger.classList.add('passanger', 'container', 'border', 'border-info', 'py-2','my-3');
      psger.innerHTML = `
        <p class="fs-3 text-info">Passanger n°${nbrOfPassangers}</p>
        <div class="row row-cols-md-3">
          <div class="mb-3">
            <label for="fname${nbrOfPassangers}" class="form-label">First name</label>
            <input type="text" name='fname[]' class="form-control" id="fname${nbrOfPassangers}" placeholder="Passanger first name" required>
          </div>
          <div class="mb-3">
            <label for="lname${nbrOfPassangers}" class="form-label">Last name</label>
            <input type="text" name='lname[]' class="form-control" id="lname${nbrOfPassangers}" placeholder="Passanger last name" required>
          </div>
          <div class="mb-3">
            <label for="date${nbrOfPassangers}" class="form-label">Birth Day</label>
            <input type="date" name='date[]' class="form-control" id="date${nbrOfPassangers}" required>
          </div>
        </div>
      `;
      passangersBox.append(psger);
      nbrOfPassangers++;
    }

    // fetch('http://localhost/flightline/flight/availableSeats',{
    //     method:'POST',
    //     body: 67
    // })
    // .then((res)=>res.json())
    // .then((data)=> console.log(data))

</script>
<?php require_once VIEWS . '/user.views/inc/footer.php' ?>