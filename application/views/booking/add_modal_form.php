<?php


$no_records = '';

if (!empty($records)) {

    $sid = $records->serviceId;
    $sTitle = $records->serviceTitle;
    $sDes = $records->serviceDescription;
    $sImages = $records->serviceImages;
    $sTumbnail = $records->serviceBanner;
    $sType = $records->serviceType;
    $sExtraInfo = $records->extraInfo;
    $scExtraInfo = $records->scExtraInfo;
    $subcatName = $records->subcatName;
    $supName = "test";
    $supId = "22";
    $cLabel = "";

    $imgArray =  array();
    if (!empty($sImages)) {
        $imgArray = json_decode($sImages);
    }


    $pChild = "0";
    $pAdult = "0";

    $type = "";
    $tSlot = "0";
    $inclusion = "";
    $exclusion = "";
    $terms = "";
    $vCode = "";
    $passengers = "";
    $baby_seats = "";
    $luggage = "";
    $opChild = 0;
    $opAdult = 0;

    if ($sExtraInfo != "") {
        $extra = json_decode($sExtraInfo);
        if (isset($extra->prices)) {
            $pChild = (int) $extra->prices->priceChild;
            $pAdult = (int) $extra->prices->priceAdult;

            // $pChild =  getDiscount($role_id, $pChild);
            // $pAdult =  getDiscount($role_id, $pAdult);
            
            $pChild =   priceCalculator($sid,'priceCountChild');
            $pAdult =   priceCalculator($sid,'priceCountAdult');

            $opChild = (int) $extra->prices->priceChild;
            $opAdult = (int) $extra->prices->priceAdult;
        }
        if (isset($extra->others)) {

            $cLabel = strtolower($extra->others->categoryLabel);
            $type = $extra->others->type;
            $tSlot = $extra->others->Totalslot;
            $inclusion = $extra->others->inclusion;
            $exclusion = $extra->others->exclusion;
            $terms = $extra->others->termsAndService;
            $vCode = $extra->others->vehicleCode;
        }
    }
    if ($scExtraInfo != "") {
        $scExtra = json_decode($scExtraInfo);
        $passengers = $scExtra->passengers;
        $baby_seats = $scExtra->baby_seats;
        $luggage = $scExtra->luggage;
    }
} else {
    // redirect('booking');

    $no_records =  "No records available...";
}

?>


<!-- Bootstrap 3.3.4 -->
<link href="<?= base_url() ?>assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- FontAwesome 4.3.0 -->
<link href="<?= base_url() ?>assets/admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons 2.0.0 -->
<link href="<?= base_url() ?>assets/admin/bower_components/Ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="<?= base_url() ?>assets/admin/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
<!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
<link href="<?= base_url() ?>assets/admin/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

<style>
    .error {
        color: red;
        font-weight: normal;
    }
</style>

<div>
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
        <h1>
            <i class="fa fa-user-circle-o" aria-hidden="true"></i> Booking Management
            <small>Add / Edit Booking</small>
        </h1>
    </section> -->

    <section class="content">
       <?php if(!empty($records)){  ?>
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
               <div class="row ">
                    <div class="col-md-12 text-center ">
                        <?php if (priceCalculator($sid,'percentage') < 0) { ?>
                            <div class="alert alert-danger alert-warning">
                                <b>Congratulation</b>! you have ( <?= priceCalculator($sid,'percentage') ?> % ) discount for this booking. <?= '<b class="text-danger"  style= "color: black;" >PRICE: ' . (priceCalculator($sid,'totalDiscount')) . ' </b><del  style= "font-size: smaller;color: brown;" >(<samll><i>' . (priceCalculator($sid,'totalOriginal')) . '</i></small>)</del> AED' ?>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <!-- Booking column -->
            <?php 
            if ($cLabel == DESERT) {
                require_once('desert_form.php');
            }else if ($cLabel == ATTRACTION) {
                require_once('attration_form.php');
            } else if ($cLabel == TRANSPORT) {
                require_once('transport_form.php');
            }
            ?>
        </div>
        <?php }else{ ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info alert-dismissable">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                     <?= $no_records ?>
                </div>
            </div>
           
        </div>
        <?php } ?>
    </section>

</div>