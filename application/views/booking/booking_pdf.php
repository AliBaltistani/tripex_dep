<style>
    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
    }

    th,
    td {
        padding: 4px;
        border: 1px solid #dddddd;
        text-align: center;
        font-size: 12px;
    }
</style>

<table>
    <tr>
        <th colspan="12">
            <h1><?= WEB_NAME ?></h1>
            <table>

                <tr>
                    <th colspan="12">
                        <br>
                        <h3>Supplier Info</h3>
                        <br>
                    </th>
                </tr>

                <tr>
                    <td>Supplier Name: </td>
                    <td><?= $users->name ?></td>
                    <td>Supplier Contact: </td>
                    <td> <?= $users->mobile ?></td>
                </tr>
                <tr>
                    <td>Supplier Email: </td>
                    <td><?= $users->email ?></td>
                    <td>Date: </td>
                    <td> <?= date('d-M-Y') ?></td>
                </tr>

            </table>
        </th>
    </tr>

    <tr>
        <th colspan="12"><br>
            <h3>Booking Info</h3><br>
        </th>

    </tr>

    <tr>
        <th scope="col">RefNo</th>
        <th scope="col">Date</th>
        <th scope="col">GuestName</th>
        <th scope="col">GuestContact</th>
        <th scope="col">Adult</th>
        <th scope="col">Child</th>
        <th scope="col">PickupDate</th>
        <th scope="col">PickupTime</th>
        <th scope="col">PickLoc</th>
        <th scope="col">DropLoc</th>
        <th scope="col">Vehicle</th>
        <th scope="col">totalPrice</th>
    </tr>
    <?php
    if (!empty($records)) {
        $count = 1;
        foreach ($records as $record) {
    ?>
            <tr>
                <td><?php echo $record->bRefNo ?></td>
                <td><?php echo $record->bDate ?></td>
                <td><?php echo $record->bGuestName ?></td>
                <td><?php echo $record->bGuestContact ?></td>
                <td><?php echo $record->bAdult ?></td>
                <td><?php echo $record->bChild ?></td>
                <td><?php echo $record->bPickupDate ?></td>
                <td><?php echo $record->bPickupTime ?></td>
                <td><?php echo $record->bPickLoc ?></td>
                <td><?php echo $record->bDropLoc ?></td>
                <td><?php echo $record->bVehicle ?></td>
                <td><?php echo $record->totalPrice ?> AED</td>

            </tr>
    <?php
        }
    }
    ?>