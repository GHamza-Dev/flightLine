<?php

$error = $data['error'] ?? null;
$values = $data['flight'] ?? null;

?>

<?php require_once VIEWS.DS.'inc/header.php' ?>
    <h1 class="fs-2 text-secondary mb-5">Update flight</h1>
    <form action="<?= URLROOT ?>flight/updateFlight" method="post">
        <div class="mb-3">
            <label for="from" class="form-label">From</label>
            <input value="<?= $values['aFrom'] ?? '' ?>" name="from" type="text" class="form-control" id="from" aria-describedby="">
            <small class="text-danger"><?= $error['from_err'] ?? '' ?></small>
        </div>
        <div class="mb-3">
            <label for="to" class="form-label">To</label>
            <input value="<?= $values['aTo'] ?? '' ?>" name="to" type="text" class="form-control" id="to">
            <small class="text-danger"><?= $error['to_err'] ?? '' ?></small>
        </div>
        <div class="mb-3">
            <label for="departtime" class="form-label">Depart time</label>
            <input value="<?= $values['departTime'] ? explode(' ',$values['departTime'])[0].'T'.explode(' ',$values['departTime'])[1] : '' ?>" name="depart" type="datetime-local" id="departtime">
            <small class="text-danger"><?= $error['depart_err'] ?? '' ?></small>
        </div>
        <div class="mb-3">
            <label for="arrivaltime" class="form-label">Arrival time</label>
            <input value="<?= $values['arrivalTime'] ? explode(' ',$values['arrivalTime'])[0].'T'.explode(' ',$values['departTime'])[1] : '' ?>" name="arrival" type="datetime-local" id="arrivaltime">
            <small class="text-danger"><?= $error['arrival_err'] ?? '' ?></small>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input value="<?= $values['price'] ?? '' ?>" name="price" type="number" id="price" step="0.01">
            <small class="text-danger"><?= $error['price_err'] ?? '' ?></small>
        </div>
        <div class="mb-3">
            <label for="seats" class="form-label">Seats</label>
            <input value="<?= $values['nbrPlaces'] ?? '' ?>" name="seats" type="number" id="seats">
            <small class="text-danger"><?= $error['seats_err'] ?? '' ?></small>
        </div>
        <input type="hidden" name="id" value="<?= $values['flightID'] ?? '' ?>">
        <button type="submit" name="update" class="btn btn-primary">Submit</button>
    </form>
<?php require_once VIEWS.DS.'inc/footer.php' ?>