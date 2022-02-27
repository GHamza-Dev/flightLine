<?php require_once VIEWS . '/user.views/inc/header.php' ?>

<?php $bookings = $data['bookings']; ?>

<div class="container my-4">
    <h2 class="text-secondary pb-2">Bookings</h2>
    <div>
        <div class="row row-cols-sm-2 border p-2 rounded">
            <div class="flex-1 ps-0">
                <?php foreach($bookings as $bk): ?>
                    <div class="d-flex justify-content-between border my-2 align-items-center p-2">
                        <p class="m-0"><?= ucwords($bk['firstName'].' '.$bk['lastName']) ?></p>
                        <div class="d-flex align-items-center">
                            <button 
                            data-fname="<?= $bk['firstName'] ?>"
                            data-lname="<?= $bk['lastName'] ?>"
                            data-bdate="<?= $bk['birthDay'] ?>"
                            data-id="<?= $bk['passengerID'] ?>"
                            class="edit-psgr btn border me-2"
                            data-bs-toggle="modal"
                            data-bs-target="#update-psgr">
                                <i class="text-primary fa-solid fa-pen-to-square"></i>
                            </button>
                            <form method="POST">
                                <button value="<?= $bk['passengerID'] ?>" class="btn border" type="submit" name="deletePsgr">
                                <i class="text-warning fa-solid fa-user-slash"></i> 
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="border py-2">
                <p><b>Appointment: </b> <?= $bookings[0]['departTime'] ?></p>
                <p><b>From: </b> <?= $bookings[0]['aFrom'] ?></p>
                <p><b>To: </b> <?= $bookings[0]['aTo'] ?></p>
                <div class="d-flex">
                    <form action="#" method="post">
                        <button class="btn btn-danger">Cancel</button>
                    </form>
                    <form class="ms-2" action="#" method="post">
                        <button class="btn btn-primary"><i class="fa-solid fa-print"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Update passanger modal -->
<div class="modal fade" id="update-psgr" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <form method="POST" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit passanger</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="">
            <label class="form-label" for="fname">First Name</label>
            <input class="form-control" id="fname" name="fname" type="text" required>
        </div>
        <div class="">
            <label class="form-label" for="lname">Last Name</label>
            <input class="form-control" id="lname" name="lname" type="text" required>
        </div>
        <div class="">
            <label class="form-label" for="bdate">Birthdate</label>
            <input class="form-control" id="bdate" name="bdate" type="date" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="updatePsgr" id="updatePsgr" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </form>
</div>


<script>
    document.querySelectorAll('.edit-psgr').forEach(element => {
        element.addEventListener('click',()=>{
            document.getElementById('fname').value = element.dataset.fname;
            document.getElementById('lname').value = element.dataset.lname;
            document.getElementById('bdate').value = element.dataset.bdate;
            document.getElementById('updatePsgr').value = element.dataset.id;
        });
    });
</script>

<?php require_once VIEWS . '/user.views/inc/footer.php' ?>