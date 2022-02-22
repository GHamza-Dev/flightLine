<?php require_once VIEWS.DS.'inc/header.php' ?>
    <h1 class="fs-2 text-secondary mb-5">Bookings</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">NIC</th>
                <th scope="col">FullName</th>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">Depart Time</th>
                <th scope="col">Arrival Time</th>
                <th scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data['bookings'] as $bk): ?>
            <tr>
                <th scope="row"><?= $bk['reservationID'] ?></th>
                <td><?= $bk['nic'] ?></td>
                <td><?= $bk['firstName'].' '.$bk['lastName'] ?></td>
                <td><?= $bk['aFrom'] ?></td>
                <td><?= $bk['aTo'] ?></td>
                <td><?= $bk['departTime'] ?></td>
                <td><?= $bk['arrivalTime'] ?></td>
                <td><?= $bk['price'].'<b>$</b>' ?></td>
                
            </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
<?php require_once VIEWS.DS.'inc/footer.php' ?>