<?php


    $sid = "0";
    $bid = "0";
    $cLabel = "";
    $vCode = "";
    $staff = "0";
    $bTour = "";
    $bType = "";
    $cName = "";
    $cPhone = "";
    $cEmail = "";
    $puDate = "";
    $puTime = "";
    $puLoc = "";
    $drpLoc = "";
    $noOfAdult = "";
    $noOfChild = "";
    $status = "";
    $sTitle = "";
    $totalPrice = 0;
    $pChild = 0;
    $pAdult = 0;
    $bThemeParksTicket = "";

    $supName = "test";
    $supId = "22";

if (!empty($bookingInfo) && !empty($records)) {

    $sid = $bookingInfo->serviceId;
    $bid = $bookingInfo->bookingId;


    $vCode = $bookingInfo->bVehicle;
    $staff = $bookingInfo->bStaff;
    $agent = $bookingInfo->bAgent;
    $bTour = $bookingInfo->bTour;
    $bType = $bookingInfo->bType;
    $status = $bookingInfo->status;

    $cName = $bookingInfo->bGuestName;
    $cPhone = $bookingInfo->bGuestContact;
    $cEmail = '';
    $puDate = $bookingInfo->bPickupDate;
    $puTime = $bookingInfo->bPickupTime;
    $puLoc = $bookingInfo->bPickLoc;
    $drpLoc = $bookingInfo->bDropLoc;

    $noOfAdult = $bookingInfo->bAdult;
    $noOfChild = $bookingInfo->bChild;
    $sTitle = $bookingInfo->bAddService;
    $totalPrice = $bookingInfo->totalPrice;

    $bThemeParksTicket = $bookingInfo->bThemeParksTicket;

    $supName = $bookingInfo->bSupplier;
    $supId = $bookingInfo->bSupplierId;

    $bExInfo = $bookingInfo->extraInfo;
    $sExtraInfo = $records->extraInfo;

    if(!empty($bExInfo)) {
        $bExtra = json_decode($bExInfo);
        $cEmail = $bExtra->cutomerEmail;
        
    }
   
    if ($sExtraInfo != "") {
        $extra = json_decode($sExtraInfo);
        if (isset($extra->prices)) {
            $pChild = (int) $extra->prices->priceChild;
            $pAdult = (int) $extra->prices->priceAdult;
        }
        if (isset($extra->others)) {
            $cLabel = strtolower($extra->others->categoryLabel);
        }
    }
   
} else {
    redirect('booking');
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-user-circle-o" aria-hidden="true"></i> Booking Management
            <small>Edit Booking</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">

            <!-- error message col -->
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

            <!-- Booking column -->
            <?php 
            if ($cLabel == DESERT) {
                include('desert_form_edit.php');
            } else if ($cLabel == ATTRACTION) {
                include('attration_form_edit.php');
            } else if ($cLabel == TRANSPORT) {
                include('transport_form_edit.php');
            }
            ?>
        </div>
    </section>

</div>