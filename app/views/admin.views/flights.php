<?php require_once VIEWS.DS.'inc/header.php' ?>
    <h1 class="fs-2 text-secondary mb-5">Flights</h1>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">From</th>
            <th scope="col">To</th>
            <th scope="col">Depart Time</th>
            <th scope="col">Arrival Time</th>
            <th scope="col">Nbr Seats</th>
            <th scope="col">Available Seats</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data['flights'] as $flight): ?>
            <tr>
                <th scope="row"><?= $flight['flightID'] ?></th>
                <td><?= $flight['aFrom'] ?></td>
                <td><?= $flight['aTo'] ?></td>
                <td><?= $flight['departTime'] ?></td>
                <td><?= $flight['arrivalTime'] ?></td>
                <td><?= $flight['nbrPlaces'] ?></td>
                <td><?= $flight['reservedPlaces'].'(?)' ?></td>
                <td class="d-flex justify-content-evenly">
                    <form action="<?= URLROOT.'flight/updateFlight' ?>" method="post">
                        <input type="hidden" name="flightId" value="<?= $flight['flightID'] ?>">
                        <button class="btn btn-primary">Update</button>
                    </form>
                    <form action="<?= URLROOT.'flight/removeFlight' ?>" method="post">
                        <input type="hidden" name="flightId" value="<?= $flight['flightID'] ?>">
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
<?php require_once VIEWS.DS.'inc/footer.php' ?>