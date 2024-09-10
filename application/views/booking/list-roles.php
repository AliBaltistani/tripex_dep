<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-user-circle-o" aria-hidden="true"></i> Booking Management
      <small>Add, Edit, Delete</small>
    </h1>
  </section>
  <section class="content">
    <div class="row" style="margin: 26px 0;">
      <?php $this->load->helper("form"); ?>
      <form action="<?php echo base_url('booking/bookingListing') ?>" method="POST" id="searchList">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 form-group">
          <div class="input-group">
            <span class="input-group-addon "><label for="fromDate" style="margin-bottom: 0 !important;">From: </label></span>
            <input id="fromDate" type="date" name="fromDate" value="<?= set_value('fromDate') ?>" class="form-control  " placeholder="From Date" autocomplete="off" />
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 form-group">
          <div class="input-group">
            <!-- <i class="fa fa-calendar"></i> -->
            <span class="input-group-addon"><label for="toDate" style="margin-bottom: 0 !important;">TO:</label></span>
            <input id="toDate" type="date" name="toDate" value="<?= set_value('toDate') ?>" class="form-control datepicker" placeholder="To Date" autocomplete="off" />
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
          <input id="searchText" type="text" name="searchText" value="<?= set_value('searchText') ?>" class="form-control" placeholder="Search Text" />
        </div>
        <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 form-group">
          <button type="submit" class="btn btn-md btn-primary btn-block searchList pull-right"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>

      </form>
      <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 form-group">
        <a href="" class="btn btn-md btn-default btn-block pull-right resetFilters"><i class="fa fa-refresh" aria-hidden="true"></i></a>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 text-right">
        <div class="form-group">
          <?php if ((check_permission('Booking', 'create_records') == 1)) { ?>
            <button type="button" id="slotcount" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              <i class="fa fa-plus"></i> New Booking
            </button>
          <?php } ?>
          <!-- <a class="btn btn-primary" href="<?php echo base_url(); ?>booking/add"></a> -->
        </div>
      </div>
    </div>
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
          <div class="col-md-12" id="js_message">
            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">My Bookings</h3>

          </div><!-- /.box-header -->

          <div class="box-body table-responsive no-padding">

            <style>
              th,
              td,
              span {
                padding: 0px 20px;
              }
            </style>
            <table class="table table-hover">
              <tr>
                <th>sr.#</th>
                <th>Booking Ref#</th>
                <th>Date</th>
                <th>Guest Name</th>
                <th>Guest Contact#</th>
                <th>Tour</th>
                <th>Type</th>
                <th>Add Service</th>
                <th>Adult</th>
                <th>Child</th>
                <th>Pickup Time</th>
                <th>Pickup Location</th>
                <th>Drop Off Location</th>
                <th>Supplier</th>
                <th>Vehicle Details</th>
                <th>Cost</th>
              </tr>

              <?php

              if (!empty($records)) {
                $count = 1;
                foreach ($records as $record) {  ?>
                  <tr style="height:10px; <?= (isUnreadBooking($record->bookingId) ? 'background:palegoldenrod;' : '') ?> ">
                    <td><?php echo $count++ ?></td>
                    <td style="overflow: hidden;width: 10px;"><span><?php echo $record->bRefNo ?></td>
                    <td><span> <?php echo $record->bDate ?></span></td>
                    <td><span> <?php echo $record->bGuestName ?></span></td>
                    <td><span> <a href="tel:<?php echo $record->bGuestContact ?>"><?php echo $record->bGuestContact ?></a></span></td>
                    <td><span> <?php echo $record->bTour ?></span></td>
                    <td><span> <?php echo $record->bType ?></span></td>
                    <td><span> <?php echo $record->bAddService ?></span></td>
                    <td><span> <?php echo $record->bAdult ?></span></td>
                    <td><span> <?php echo $record->bChild ?></span></td>
                    <td><span> <?php echo $record->bPickupTime ?></span></td>
                    <td><span> <?php echo $record->bPickLoc ?></span></td>
                    <td><span> <?php echo $record->bDropLoc ?></span></td>
                    <td><span>
                        <?php foreach ($suppliers as $sup) {
                            if($sup->supid == $record->bSupplierId) {
                               echo  $sup->name . "<a href='tel:" . $sup->mobile . "'>(" . $sup->mobile . ") </a>";
                            }
                          }   
                          ?>
                      </span>
                    </td>
                    <td ><span><?php echo $record->bVehicle; ?></span></td>
                    <td><span><?php echo $record->bCost; ?></span></td>
                  </tr>
              <?php
              } } else {
                echo '<tr ><td class="text-center py-4" colspan="9">No booking records found...</td></tr>';
              }
              ?>
            </table>

          </div><!-- /.box-body -->
          <div class="box-footer clearfix">
            <?php echo $this->pagination->create_links(); ?>
          </div>
        </div><!-- /.box -->
      </div>
    </div>
  </section>

  <!-- Modal -->
  <?php
  require_once('booking_model.php')
  ?>

  <!-- Modal -->
  <div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="supplierModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="supplierModalLabel" style="float: left;">Supplier for this Booking </h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Booking Model -->
          <ul class="sidebar-menu  py-4" data-widget="tree">
            <li class="treeview menu-open " style="background:black !important;">
              <a href="#">
                <i class="fa fa-anchor"></i> <span>Select From List</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu py-5" style="background: rgb(255, 255, 255) !important; display: block;">
                <li>
                  <div class="form-group ">
                    <br>
                    <select class="form-control  required" style="width: 50%; margin:auto;" id="ex_supplier_select1" name="ex_supplier_select" required>
                      <option value="" selected>--- Select supplier ---</option>
                      <?php foreach ($suppliers as $sup) { ?>
                        <option value="<?= $sup->userId ?>"><?= $sup->name . " (" . $sup->mobile . ")" ?></option>
                      <?php } ?>
                    </select>

                    <div class="modal-footer  m-auto " style="text-align:center;">
                      <br>
                      <button type="submit" name="submit" id="ex_supplier_save" onclick="ex_supplier_save()" class="btn btn-success">Save changes</button>
                    </div>
                  </div>
                </li>
              </ul>
            </li> <!-- ./select -->

            <li class="treeview" style="background:black !important;">
              <a href="#">
                <i class="fa fa-plus"></i> <span>Add / Edit Supplier</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu py-5" style="background:#fff !important;">
                <li>
                  <div class="form-group " id="ex_supplier">
                    <br>
                    <div id="new_supplier_container"></div>
                    <br>
                  </div>
                </li>
              </ul>
            </li> <!-- ./create new -->

          </ul>

          <!-- End Booking model -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <script src="<?php echo base_url(); ?>assets/admin/js/addUser.js" type="text/javascript"></script>

</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/common.js" charset="utf-8"></script>

<script type="text/javascript">
  jQuery(document).ready(function() {

    jQuery('ul.pagination li a').click(function(e) {
      e.preventDefault();
      var link = jQuery(this).get(0).href;
      var value = link.substring(link.lastIndexOf('/') + 1);
      jQuery("#searchList").attr("action", baseURL + "booking/" + value);
      jQuery("#searchList").submit();
    });
  });

  var bookingId = 0;

  function getID(bid, spid) {

    bookingId = bid;
    const supplierId = spid;
    $.ajax({
      type: 'POST',
      url: '<?= base_url() ?>Booking/addSupplier',
      data: {
        id: bookingId,
        sid: supplierId
      },
      dataType: 'json',
      beforeSend: function() {
        $('#new_supplier_container').html('<h2 class="text-center"> loading.. </h2>');
      },
      success: function(response) {
        $('#new_supplier_container').html(response);
      },
      error: function(xhr, status, error) {
        $('#new_supplier_container').html(xhr.responseText);
        console.error(xhr.responseText);
      }
    });
  }

  function ex_supplier_save(tag) {

    const ex_supplier = $(tag).find(':selected').val();
    const bookingId = $(tag).find(':selected').data('bookingid');
    const vehicle = $(tag).find(':selected').data('vehicle') ?? '';
    let vtdid = "#" + $(tag).find(':selected').data('vtdid') ?? '';

    if (vehicle == null || vehicle == undefined || vehicle == '') {
      if (!confirm("This supplier has no vehicle details. Please update the vehicle details before submitting. Do you want to proceed?")) {
        return;
      }
    }
    if (ex_supplier != "" && bookingId != 0) {

      $.ajax({
        type: 'POST',
        url: '<?= base_url() ?>Booking/addExSupplier',
        data: {
          id: bookingId,
          sid: ex_supplier,
          vehicle: vehicle
        },
        dataType: 'json',
        beforeSend: function() {
          $(tag).attr('disabled', 'disabled');
        },
        success: function(response) {
          $(tag).removeAttr('disabled');
          if (response.status = true) {

            $('#ex_supplier_save').html('Saved');
            $('#js_message').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Supplier Updated for this booking</div>')
            $(vtdid).html('<span>' + vehicle + '</span>');
            // window.location.href = '<?= base_url() ?>booking';

          } else if (response.status = false) {
            $('#js_message').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Supplier Updated failed.</div>')
          } else {
            alert("Access denied..!");
          }

        },
        error: function(xhr, status, error) {
          $(tag).removeAttr('disabled');
          alert(xhr.responseText);
          console.error(xhr.responseText);
        }
      });
    } else {
      alert('Invalid Information...');
    }

  }

  function updateBookingCost(el) {

    const bkid = $(el).data('bookingid');
    const cost = $(el).val();
    if ( isNumeric(cost) == false) {
      alert('The cost value must be a number');
      return;
    }
    if (isNumeric(bkid) == false ) {
      alert('Error!. Missing Booking Information. ');
      return;
    }
    if (cost != "" && bkid != 0) {
      $.ajax({
        type: 'POST',
        url: '<?= base_url() ?>Booking/updateBookingCost',
        data: {
          id: bkid,
          cost: cost,
        },
        dataType: 'json',
        beforeSend: function() {
          $(el).attr('disabled', 'disabled');
        },
        success: function(response) {
          $(el).removeAttr('disabled');
          if (response.status = true) {
            $('#ex_supplier_save').html('Saved');
            $('#js_message').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Cost updated successfully</div>')
            // window.location.href = '<?= base_url() ?>booking';

          } else if (response.status = false) {
            $('#js_message').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Cost Updated failed.</div>')
          } else {
            alert("Access denied..!");
          }

        },
        error: function(xhr, status, error) {
          $(el).removeAttr('disabled');
          alert(xhr.responseText);
          console.error(xhr.responseText);
        }
      });
    } else {
      alert('Invalid Information...');
    }

  }

  var isNumeric = function(num){
    return (typeof(num) === 'number' || typeof(num) === "string" && num.trim() !== '') && !isNaN(num);  
}
</script>


<?php if (empty(set_value('toDate'))) { ?>
  <script>
    window.onload = function() {
      // Get today's date
      var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
      var yyyy = today.getFullYear();

      // Format today's date as yyyy-mm-dd
      today = yyyy + '-' + mm + '-' + dd;

      // Set the value of the date input field to today's date
      document.getElementById("toDate").value = today;
    };
  </script>

<?php } ?>
