<?php
  
    $spId ='';
    $spName =  '';
    $spEmail = '';
    $spMobile =  '';
    $spStatus = '';

if(!empty($suppliers)){
    $spId = $suppliers->id ?? '';
    $spName = $suppliers->name ?? '';
    $spEmail = $suppliers->email ?? '';
    $spMobile = $suppliers->mobile ?? '';
    $spStatus = $suppliers->isDeleted ?? '';
}


if (!empty($records)) {

    $sid = $records->serviceId;
    $bid = $records->bookingId;
    $rno = $records->bRefNo;
    $staff = $records->bStaff;
    $agent = $records->bAgent;
    $date = $records->bDate;
    $gName = $records->bGuestName;
    $gNum = $records->bGuestContact;
    $tour = $records->bTour;
    $type = $records->bType;
    $tpTicket = $records->bThemeParksTicket;
    $aService = $records->bAddService;
    $adult = $records->bAdult;
    $child = $records->bChild;
    $puDate = $records->bPickupDate;
    $puTime = $records->bPickupTime;
    $puLoc = $records->bPickLoc;
    $doLoc = $records->bDropLoc;
    // $spName = $records->bSupplier; 
    $vCode = $records->bVehicle;
    $tPrice = $records->totalPrice;
    $cost = $records->bCost;
    $sale = $records->bSale;
    $status = $records->status;
    $extraInfo = $records->extraInfo;

    
} else {
    redirect('booking');
}
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-user-circle-o" aria-hidden="true"></i> Booking Management
            <small>Detail information</small>
        </h1>
    </section>
    <section class="content">

        <!-- <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>booking/add"><i class="fa fa-plus"></i> Add New Booking</a>
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-md-12">
                <?php
                $this->load->helper('form');
                $error = $this->session->flashdata('error');
                if ($error) {
                ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>
                <?php
                $success = $this->session->flashdata('success');
                if ($success) {
                ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>

                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> Guset Details </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>Guest Name : </th>
                                <td> <?= $gName ?> </td>
                            </tr>
                            <tr>
                                <th>Guest Contact : </th>
                                <td> <?= $gNum ?> </td>
                            </tr>
                            <tr>
                                <th>Guest Email : </th>
                                <td> <?= "abc123@gmail.com" ?> </td>
                            </tr>
                            <tr>
                                <th>Status : </th>
                                <td id="pay_status1">
                                    <?php
                                        if ($status == ACTIVE) {
                                        ?> <span class="label label-success">CONFIRMED</span>
                                    <?php } else if ($status == CANCEL) {
                                        ?> <span class="label label-danger">CACELED</span>
                                    <?php } else { ?>
                                        <span class="label label-warning">PENDING</span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <!-- <tr>
                                <th>Action: </th>
                                <td>
                                    <a class="btn btn-sm btn-info" href="<?php echo base_url() . 'booking/view-more?serId=' . $bid; ?>" title="Edit"><i class="fa fa-send"></i>&nbsp; &nbsp;Payment Resquest</a>
                                    
                                </td>
                            </tr> -->
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>

            <?php if(!empty($suppliers)){ ?>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> Supplier Details </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>Supplier Name : </th>
                                <td> <?= $spName ?> </td>
                            </tr>
                            <tr>
                                <th>Supplier Contact : </th>
                                <td> <?= $spMobile ?> </td>
                            </tr>
                            <tr>
                                <th>Supplier Email : </th>
                                <td> <?= $spEmail ?> </td>
                            </tr>
                            <tr>
                                <th>Supplier Status : </th>
                                <td>
                                    <?php if ($spStatus == '0') { ?>
                                        <span class="label label-success">Active</span>
                                    <?php } else { ?>
                                        <span class="label label-warning">Not Available</span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <!-- <tr>
                                <th>Action: </th>
                                <td>
                                    <a class="btn btn-sm btn-success" href="<?php echo base_url() . 'booking/sendBookingPDF?id=' . $spId; ?>" title="Send Booking Detail to Supplier">
                                        <img width="24px" src="data:image/png;base64,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">
                                        Send Booking Info
                                    </a>
                                    <button type="button" id="" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fa fa-plus"></i>&nbsp;Add Supplier
                                    </button>
                                    <a class="btn btn-sm btn-danger deleteBooking" href="#" data-bookingid="<?php echo $bid; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr> -->
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
            <?php } ?>

        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> Booking Detail</h3>
                    </div><!-- /.box-header -->

                    <div class="box-body table-responsive no-padding">

                        <table class="table table-hover">

                            <tr>
                            <th rowspan="16">.</th>
                                <th>Booking Ref.#</th>
                                <td><b><?= $rno ?></b></td>
                            </tr>
                            <?php if ($is_admin == 1) { ?>
                                <tr>
                                    <th>Staff</th>
                                    <td><?php echo $staff;  ?></td>
                                </tr>
                                <tr>
                                    <th>Agent</th>
                                    <td><?php echo $agent; ?></td>
                                </tr>

                                <tr>
                                <th>Type</th>
                                <td><?php echo $type; ?></td>
                            </tr>

                            <tr>
                                <th>Theme Parks Ticket</th>
                                <td><?php echo $tpTicket; ?></td>
                            </tr>

                        
                            <?php } ?>
                            <tr>
                                <th>Booking Date</th>
                                <td><?php echo $date; ?></td>
                            </tr>

                            <tr>
                                <th>Tour</th>
                                <td><?php echo $tour; ?></td>
                            </tr>

                            <tr>
                                <th>AddService</th>
                                <td><?php echo $aService; ?></td>
                            </tr>
                            <tr>

                                <th>Adult</th>
                                <td><?php echo $adult; ?></td>
                            </tr>

                            <tr>
                                <th>Child</th>
                                <td><?php echo $child; ?></td>
                            </tr>

                            <tr>

                                <th>Pickup Date</th>
                                <td><?php echo $puDate; ?></td>
                            </tr>

                            <tr>

                                <th>Pickup Time</th>
                                <td><?php echo $puTime; ?></td>
                            </tr>

                            <tr>

                                <th>PickLoc</th>
                                <td><?php echo $puLoc; ?></td>
                            </tr>

                            <tr>

                                <th>DropLoc</th>
                                <td><?php echo $doLoc; ?></td>
                            </tr>

                            <tr>
                                <th>Vehicle</th>
                                <td><?php echo $vCode; ?></td>
                            </tr>

                            <tr>
                                <th>total Price</th>
                                <td><?php echo $tPrice ." AED"; ?></td>
                            </tr>    

                        </table>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>



</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Multiple slots -->
                <?php
                $data['roles'] = $roles;
                $data['bookingId'] = $bid;
                $data['params'] = 'booking/view-more?serId=' . $bid;
                $this->load->view('suppliers/form_data', $data) ?>
                <!-- End Multiple slots -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="submit" name="submit" id="trans_form_submit" class="btn btn-success">Save changes</button> -->
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<script src="<?php echo base_url(); ?>assets/admin/js/addUser.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/common.js" charset="utf-8"></script>

<!-- <script>
    $(document).ready(function() {
        $('#transaction_submit').submit(function(event) {
            event.preventDefault(); // Prevent form submission
            const serializedData =  serializeForm();
            jsonString = JSON.stringify(serializedData);
            updateTransaction(jsonString);

            // console.log(jsonString);
        });

        function serializeForm() {
            const form = document.getElementById('transaction_submit');
            const formData = new FormData(form);
            const serializedData = {};

            for (const [key, value] of formData.entries()) {
                if (!serializedData[key]) {
                    serializedData[key] = [];
                }
                serializedData[key] = value;
            }

            return serializedData; 
            // You can use serializedData object as needed
       }


        function updateTransaction(data) {
            $.ajax({
                type: 'POST',
                url: '<?= base_url(); ?>/Booking/updateTransaction', // Update with your controller and method URL
                data: {
                    data: data
                },
                beforeSend: function() {
                    $('#trans_form_submit').text('Saving...');
                },
                success: function(response) {
                   if(response){
                    $('#pay_status').html('<span class="label label-success">Success</span>');
                    $('#pay_status1').html('<span class="label label-success">Success</span>');
                   }
                   $('#trans_form_submit').text('Save Changes');
                },
                error: function(xhr, status, error) {
                    $('#trans_form_submit').text('Save Changes');
                    alert('Error saving data' + error);
                    // console.error('Error saving data to session:', error);
                }
            });
        }

    });
</script> -->