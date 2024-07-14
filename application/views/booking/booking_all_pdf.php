
 <style>
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }
        th, td {
            padding: 4px;
            border: 1px solid #dddddd;
            text-align: center;
            font-size: 8px;
        }
        @media screen and (max-width: 600px) {
            table {
                border: 0;
            }
            table caption {
                font-size: 1.3em;
            }
            table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }
            table tr {
                border-bottom: 3px solid #ddd;
                display: block;
                margin-bottom: .625em;
            }
            table td {
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: .8em;
                text-align: right;
            }
            table td::before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }
            table td:last-child {
                border-bottom: 0;
            }
        }
    </style>


                  <table class="table table-hover">
                    <thead>
                        <tr>
                            <th colspan="22">
                                <h2><?=WEB_NAME?></h2> <br>
                                <h5> All Booking Details </h5>
                            </th>
                        </tr>
                        <tr scope="row">
                        <th scope="col">sr.#</th>
                        <th scope="col">RefNo</th>
                        <th scope="col">Staff</th>
                        <th scope="col">Agent</th>
                        <th scope="col">Date</th>
                        <th scope="col">GuestName</th>
                        <th scope="col">GuestContact</th>
                        <th scope="col">Tour</th>
                        <th scope="col">Type</th>
                        <th scope="col">ThemeParksTicket</th>
                        <th scope="col">AddService</th>
                        <th scope="col">Adult</th>
                        <th scope="col">Child</th>
                        <th scope="col">PickupDate</th>
                        <th scope="col">PickupTime</th>
                        <th scope="col">PickLoc</th>
                        <th scope="col">DropLoc</th>
                        <th scope="col">Supplier</th>
                        <th scope="col">Vehicle</th>
                        <th scope="col">totalPrice</th>
                        <th scope="col">Cost</th>
                        <th scope="col">Sale</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($records))
                    {
                        $count = 1;
                        foreach($records as $record)
                        { 
                    ?>
                    <tr style="height:10px;">
                        <td data-label="sr."><?php echo $count++ ?></td>
                        <td data-label="ref"><?php echo $record->bRefNo ?></td>
                        <td data-label="staff"><?php echo $record->bStaff  ?></td>
                        <td data-label="agent"><?php echo $record->bAgent ?></td>
                        <td data-label="date"><?php echo $record->bDate ?></td>
                        <td data-label="name"><?php echo $record->bGuestName ?></td>
                        <td data-label="contact"><?php echo $record->bGuestContact ?></td>
                        <td data-label="tour"><?php echo $record->bTour ?></td>
                        <td data-label="type"><?php echo $record->bType ?></td>
                        <td data-label="ticket"><?php echo $record->bThemeParksTicket ?></td>
                        <td data-label="service"><?php echo $record->bAddService ?></td>
                        <td data-label="adult"><?php echo $record->bAdult ?></td>
                        <td data-label="child"><?php echo $record->bChild ?></td>
                        <td data-label="pickup date"><?php echo $record->bPickupDate ?></td>
                        <td data-label="pickup time"><?php echo $record->bPickupTime ?></td>
                        <td data-label="pickup location"><?php echo $record->bPickLoc ?></td>
                        <td data-label="dropoff location"><?php echo $record->bDropLoc ?></td>
                        <td data-label="supplier"><?php echo $record->bSupplier ?></td>
                        <td data-label="vehicle"><?php echo $record->bVehicle ?></td>
                        <td data-label="price"><?php echo $record->totalPrice ?></td>
                        <td data-label="cost"><?php echo $record->bCost ?></td>
                        <td data-label="sale"><?php echo $record->bSale ?></td>
                        
                    </tr>
                    <?php
                        }
                    }
                    ?>
                    </tbody>
                  </table>
                  
               
