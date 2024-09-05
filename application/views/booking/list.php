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
            <h3 class="box-title">Booking List</h3>

            <div class="box-tools">
              <a href="<?php echo base_url('booking/exportToExcel'); ?>">
                <img height="35px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAC9ElEQVR4nGNgGAWjgLaAp8jiPy0wd5FFx5D1gFqTF/08wUMDDxy+t/2/erMPfTxBCw/ceXuCfp7goZEH6OYJHhp64A49PEFrD9yhtSfo4YE7tPQEvTxwh1aeoKcH7tDCE/T2wB00TwxKD5CCGUY9UDQCYqBobfd/ZJC6tBFDDW+x5f+T9y/D1Ry+cw4sNig8wF9i9f/S01twxz18++y/UKktipr4RTVw+Z9/fv036ggfPDEAwq6T0///+/cP7sicVe1wOcFSm/93Xz+Gy3Xsmju4khAPFK89vwfuyEfvXvwXLoPEQun6Prj4vTdP/ouW2w9OD6g3+v3/+vMb3LEl63r/S1Q6/X/56S1cLHh28eDLxDxIuHXHbLhjX3x683/yweVw/vqLewdnKcSDhEHJA5SJ0cHnH1//qzX6Dn4P8BRZ/I9ZUIXhgfIN/SSbwzNQHsha2YrhgcqNE4eGB5Tqvf6///YJ7Ojff//8//H7F5j95ce3/1rNAYPfA2uRitI5R9ehZOKd148Nbg8EzSqEO/bbrx/gYlW+1uP/x++f4eKg/DEoPSBW4fj/wduncIf27FkIl2vaPhOlaJWudsFqhvMCdwxMNw9MP7wK7khQHpCtcUMpWp9+eAWXn3VkzeDygP2EpP9//v6FO7B682QMNQVruuDyf//9/e88KRWnB1yjUrBimnhAoMT6/8UniJbos4+v/4tVOGBVd/PlA7i6q8/vght5A+4BamLnUQ9gAaMxUIQ/uThjwUMiDwx5DzjOcwM71qUsAqeDCWGXqJQZA+YBhSZbSIjP9/jvkhVLjgeOeXjksg+YB0BYu8cR4omZnv9dExNJcfxzp7h06QFNQiDMW2zx33iyM8QTE33/u8YkE3Z8ZPIv9+gUW6IcT2sP8IBq6FLL/zazXCH5oS2IoAfcolLSiHY8PTzAA2rJVln/dyAiUxOVaQfCAzzEZWriMu1gAPah8RKukclPyMq0gwW4RKdYuEQl/yA50w4mAMqwhDItAFeHnkSmuwlpAAAAAElFTkSuQmCC">
              </a>
              <a href="<?php echo base_url('booking/exportToPDF'); ?>">
                <img height="35px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAYAAAA6/NlyAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEqUlEQVR4nO2ae0xbVRzHvwxdcGmhZXG4B4bFuZDFuGQGpzEhI7CQReJjE5aNWDZhZgvGGGZlOhEyzVA3gsORoaKyVav4x+aLyMJUUIMOp04RM3nI3IDyGDAopYOVfs29dLdcaMEHyC233+T7R8/53ZP7Oeee8zvnpIBffvnll19zSAwFZ8x7Ms4yO3seVANsNpHPZTYyJSUIqgE2m8jnn7UwNTEUqgE2m8jcfb00JC5VD7DZRObl2piyMVI9wGYTRw4dHGJa0l2qAaYAXXR4hNu2blQNMM0mOt444mRqcppqgCmMdEkxHTsNz6gGmAL0sbdp35nyimqAaTbR+c5R9ux6pFQ1wBT87jG2pKdV+TSwWTO1P9CAX2jBuhDwsh6cc8DvacByLXg2BLTowJFxz8wJ4I+1YE0w+KcOHJ7iGZ8GbtaBg/p/9oxPA/Nf2A883aICRtU/wjMphqp9hLcnyp0QTd6slccIv8fGPPwgGX83edN8zyBb7yN3bPHsWQf2pEEb+eoBMuz60Zi1kR7DaO0nC14ml9wgb7PlAr1KKcDDPd20t7bQOTLifrniQjHGdqcb+Eq7hcO9PXKIH2vIcI3Upv3iKLDDNsArljaZFQP8016juEs6vnwRO76pcvXCMLlcR+sY4KqHEsS4EyuXsvFosRv6tUNSm4Mu4N+PFEzYaioGuDnLyPoQ8EwwWG1IcoNEr5YBNyQl8FwIeDoYLNWAreWfiuVO2wC5OEgGfLGogA0hkFkxwB1ZRqmsK2//aKHTSevKMBnwpc0JUly/HqxJTXZ3TswdMuDeso/IpA1ux0YpB9h6sox8YS95opR0OMQyy6mT4hHOG7Dg8/fHSXX2e6NlwBNUWaEc4PG6XFfLsluXiMe5yYD7s550190eIQMe6r5Ea12t5K6S15UD3N9Yz9byMjaZ3mJ1ajLfD50vzTmvwLcto6OrUyzv/fUXdusnX7SEg7/iVmmzBvxEC57XuWPGAvfn55KPbScL88j+PrFMSGVVD8TTMW6Vbikq4AUdJHe6OuTLVeuYHZcjGkbmSN7Ndf8bcEuWURwhm4fz7Fjg8XLYbPz2UQO/D3bHXwPuKCrwuBNzgXpyzowDW5ubRLc9vsPrfte65hYpbkBwUwM7vq5k7f4cMR9/ppXfbPScOc3B1ha2vbRPecBm12f8m4ccec19es/3VUIeFvL21XHxH7rqhTrFATe4NgS9k1zNDI2JEyxc5bTrJoJKqUoHNurALr0CgTkL9gMb/SM8faL/k4Z/DtO/aOE/dUJDxAq+GJMpOS65wltaqoCRmZL3cIVPzuGRhfMYm3zKG6Q3VyGRgT4JLFwUfLU4jAvT2/8e7O6rfYjKiAWg9UlgZyj4uRZ8atUGBhidUwE7EZN/EIAAHOCTwILtevC4BkxYf2By4OTvygBsArAA06Qts+hdCJxfiLR6i0fY9M4/EBRqALBsumBnG1jw01i0ugRPDNhlsBnDdkRuzgCwBnNMAQDWI/Zwvgw4/s1CAPEAlPV/62mSMD83wfCDkHeJlJ8rASQCCMYcVjgW3GhA6rlqaMO3AYiAChTlmtdroRIFArgHwHWz/SJQqv4C4t1h2lzR9noAAAAASUVORK5CYII=">

              </a>


            </div>

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
                <th>Staff</th>
                <th>Agent</th>
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
                <th>Sale</th>

                <th class="text-center">Actions</th>
              </tr>

              <?php

              if (!empty($records)) {
                // pre($records); die;
                $count = 1;
                foreach ($records as $record) {
              ?>
                  <tr style="height:10px; <?= (isUnreadBooking($record->bookingId) ? 'background:palegoldenrod;' : '') ?> ">
                    <td><?php echo $count++ ?></td>
                    <td style="overflow: hidden;width: 10px;"><span><?php echo $record->bRefNo ?></td>
                    <td><span> <?php echo $record->bStaff; ?></span></td>
                    <td><span> <?php echo $record->bAgent; ?></span></td>
                    <td><span> <?php echo $record->bDate ?></span></td>
                    <td><span> <?php echo $record->bGuestName ?></span></td>
                    <td><span> <a href="tel:<?php echo $record->bGuestContact ?>"><?php echo $record->bGuestContact ?></a></span></td>
                    <td><span> <?php echo $record->bTour ?></span></td>
                    <td><span> <?php echo $record->bType ?></span></td>
                    <td><span> <?php echo substr($record->bAddService, 0, 5) ?>..</span></td>
                    <td><span> <?php echo $record->bAdult ?></span></td>
                    <td><span> <?php echo $record->bChild ?></span></td>
                    <td><span> <?php echo $record->bPickupTime ?></span></td>
                    <td><span> <?php echo $record->bPickLoc ?></span></td>
                    <td><span> <?php echo $record->bDropLoc ?></span></td>
                    <td><span>
                        <select class="form-control " onchange="ex_supplier_save(this)" id="ex_supplier_select" name="ex_supplier_select" style="width:200px;">
                          <option data-bookingid="" data-vehicle="" value="">--- Select supplier ---</option>
                          <?php foreach ($suppliers as $sup) {
                            $selected = ($sup->supid == $record->bSupplierId) ? 'selected' : '';
                          ?>
                            <option <?php echo $selected; ?>
                              data-vtdid="<?php echo 'vehicle-js_' . $count; ?>"
                              data-bookingid="<?php echo $record->bookingId; ?>"
                              data-vehicle="<?php echo $sup->vehicle; ?>"
                              value="<?= $sup->supid ?>">
                              <?= $sup->name . "<a href='tel:" . $sup->mobile . "'>(" . $sup->mobile . ") </a>" ?>
                            </option>
                          <?php } ?>
                        </select>
                      </span>
                    </td>
                    <td id="<?php echo 'vehicle-js_' . $count; ?>"><span><?php echo $record->bVehicle; ?></span></td>
                    <td><span><input type="text" name="" onchange="updateBookingCost(this)" data-bookingid="<?php echo $record->bookingId; ?>"  id="" value="<?php echo $record->bCost; ?>"></span></td>
                    <td><span><?php echo $record->bSale; ?></span></td>

                    <td class="text-center" style="display: flex;">

                      <!-- <?php if ((check_permission('Suppliers', 'create_records') == 1)) { ?>
                        <a href="#" onclick="getID(<?= $record->bookingId ?>,<?= $record->bSupplierId ?>)" class="btn  <?= ($record->bSupplierId) ? 'btn-success' : 'btn-primary'; ?>" data-toggle="modal" data-target="#supplierModal" title="Add Supplier">
                          <i class="fa <?= ($record->bSupplierId) ? 'fa-minus' : 'fa-plus'; ?> "></i>
                        </a> |
                      <?php } ?> -->

                      <!-- <a class="btn btn-sm btn-info" href="<?php echo base_url() . 'booking/view-more?serId=' . $record->bookingId . "&nid=" . getUnreadId($record->bookingId); ?> " title="View More"><i class="fa fa-eye"></i></a> | -->


                      <?php if ((check_permission('Booking', 'edit_records') == 1)) { ?>
                        <a class="btn btn-sm btn-warning" href="<?php echo base_url() . 'booking/edit-booking?bid=' . $record->bookingId; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                        |
                      <?php } ?>

                      <?php if ((check_permission('Booking', 'delete_records') == 1)) { ?>
                        <a class="btn btn-sm btn-danger deletecommon" href="#" data-taskname="booking" data-col="bookingId" data-taskid="<?php echo $record->bookingId; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                        |
                      <?php } ?>

                      <?php if ((check_permission('Booking', 'total_access') == 1)) { ?>

                        <br style="margin: 5px 0;">
                        <hr style="margin: 5px 0;">
                        <a class="btn btn-sm btn-success  " href="<?= base_url('b2c/booking/process-checkout?bid=' . $record->bookingId) ?>" title="Payment Request">
                          <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 27 27">
                            <g clip-path="url(#clip0_2102_235)">
                              <path d="M9.84668 19.8136V25.0313C9.84754 25.2087 9.90418 25.3812 10.0086 25.5246C10.1129 25.6679 10.2598 25.7748 10.4283 25.8301C10.5968 25.8853 10.7784 25.8861 10.9474 25.8324C11.1164 25.7787 11.2642 25.6732 11.3699 25.5308L14.4221 21.3773L9.84668 19.8136ZM26.6486 0.156459C26.5218 0.0661815 26.3725 0.0127263 26.2173 0.00200482C26.062 -0.00871662 25.9068 0.0237135 25.7688 0.0957086L0.456308 13.3145C0.310668 13.3914 0.190668 13.5092 0.111035 13.6535C0.0314025 13.7977 -0.00439878 13.962 0.00802526 14.1262C0.0204493 14.2905 0.0805582 14.4475 0.180975 14.5781C0.281392 14.7087 0.417748 14.8071 0.573308 14.8613L7.61018 17.2666L22.5963 4.45283L10.9998 18.4242L22.7932 22.4551C22.9102 22.4944 23.0344 22.5077 23.1571 22.4939C23.2798 22.4802 23.398 22.4399 23.5034 22.3757C23.6089 22.3115 23.699 22.225 23.7676 22.1223C23.8361 22.0196 23.8814 21.9032 23.9002 21.7812L26.9939 0.968709C27.0168 0.81464 26.9967 0.657239 26.9357 0.513898C26.8748 0.370556 26.7754 0.246854 26.6486 0.156459Z"></path>
                            </g>
                          </svg>
                        </a> |

                        <a class="btn btn-sm " style="background-color:yellowgreen;" href="<?php echo base_url() . 'booking/confirm-booking?bid=' . $record->bookingId . "&spId=" . $record->bSupplierId; ?>" title="Confirm Booking">
                          <i class="fa fa-heart"></i>
                        </a> |
                        <a class="btn btn-sm btn-danger btn-outline " href="<?php echo base_url() . 'booking/cancel-booking?bid=' . $record->bookingId ?>" title="Cancel Booking">
                          <i class="fa fa-close text-danger"></i>
                        </a>
                      <?php } ?>
                    </td>
                  </tr>
              <?php
                }
              } else {
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
