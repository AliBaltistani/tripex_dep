<?php
if (!empty($serviceInfo)) {

$sid = $serviceInfo->serviceId;
$sTitle = $serviceInfo->serviceTitle;
$sDes = $serviceInfo->serviceDescription;
$sImagesJsn = $serviceInfo->serviceImages;
$sTumbnail = $serviceInfo->serviceBanner;
$sType = $serviceInfo->serviceType;
$spName = $serviceInfo->supplierName;
$spId = $serviceInfo->supplierId;
$sExtraInfoJsn = $serviceInfo->extraInfo;
$cId = $serviceInfo->categoryId;
$scId = $serviceInfo->subcategoryId;
$status = $serviceInfo->status;


$imgArray =  array();
if (!empty($sImagesJsn)) {
	$imgArray = json_decode($sImagesJsn);
}

$pChild = "0";
$pChildL = "";
$pAdult = "0";
$pAdultL = "";
$cLabel = "";
$type = "";
$tSlot = "0";
$inclusion = "";
$exclusion = "";
$terms = "";
$vCode = "";
$passengers = "";
$baby_seats = "";
$luggage = "";

if ($sExtraInfoJsn != "") {
	$extra = json_decode($sExtraInfoJsn);

    
	if (isset($extra->prices)) {
		$pChild = $extra->prices->priceChild;
		$pAdult = $extra->prices->priceAdult;
		$pAdultL = $extra->prices->priceAdultL ?? '';
		$pChildL = $extra->prices->priceChildL ?? '';
        $temp_SeatOp = (object) [
           'bsLabel' => [ 0 => ''],
           'bsAges' =>  [ 0 => ''],
           'bsPrice' => [ 0 => ''],
        ];
		  $babySeatOp  = json_decode($extra->prices->babySeats ?? json_encode($temp_SeatOp));

        // pre($babySeatOp); die;
	}
    
	if (isset($extra->others)) {
		$cLabel = strtolower($extra->others->categoryLabel);
		$type = $extra->others->type ??  '';
		$vCode = $extra->others->vehicleCode ?? '';
		$tSlot = $extra->others->Totalslot ?? '';
		$inclusion = $extra->others->inclusion ?? '';
		$exclusion = $extra->others->exclusion ?? '';
		$terms = $extra->others->termsAndService ?? '';
		$discount_as = $extra->others->discount_as ?? 'total';
		$apply_tax = $extra->others->apply_tax ?? '1';
        
	}


    if($tSlot != "0"){
       $slotsArr = json_decode($tSlot);
       $this->session->set_userdata('slot_data', $slotsArr);
    }
} 


}else{
	redirect('services');
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-user-circle-o" aria-hidden="true"></i> Services Management
            <small>Edit Existing Service</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->

                <!-- display errors -->
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        // $this->load->helper('form');
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
                <!-- end display errors -->

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Service Details for <b>( <?= $serviceType; ?>)</b></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <?php echo form_open_multipart('services/edit_service' . $parms); ?>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" name="serviceLabel" value="<?= strtolower($cLabel); ?>" required>
                                    <label for="title">Services Title *</label>
                                    <input type="text" class="form-control required" value="<?= (set_value('title'))?set_value('title'): $sTitle; ?>" id="title" name="title" maxlength="256" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="role">Status</label>
                                    <select class="form-control required" id="status" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="<?= ACTIVE ?>" <?php if (set_value('status') == ACTIVE || $status == ACTIVE) {
                                                                            echo "selected=selected";
                                                                        } ?>>Publish</option>
                                        <option value="<?= INACTIVE ?>" <?php if (set_value('status') == INACTIVE || $status == INACTIVE) {
                                                                            echo "selected=selected";
                                                                        } ?>>Unpublish</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="role">Select <?= ucfirst($cLabel); ?></label>
                                    <select class="form-control required" id="subcatId" name="subcatId" required>
                                        <option value="">Select Category</option>
                                        <?php foreach ($subcategoryInfo as $single) {  ?>
                                            <option value="<?= $single->subcatId; ?>" <?php if ($single->subcatId == set_value('subcatId') || $single->subcatId == $scId) {
                                                                                            echo "selected=selected";
                                                                                        } ?>><?= $single->subcatName; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <?php 
                            if ($cLabel == ATTRACTION) { include('edit-attraction.php'); }
                                  else if ($cLabel == TRANSPORT) { include('edit-transport.php'); }
                              ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Overview *</label>
                                    <textarea class="form-control required" id="description" name="description"><?= (set_value('description'))?set_value('description'): $sDes ; ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Inclusion">Inclusion *</label>
                                    <textarea class="form-control required" id="Inclusion" name="inclusion"><?= (set_value('inclusion'))?set_value('inclusion'): $inclusion ; ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Exclusion">Exclusion *</label>
                                    <textarea class="form-control required" id="Exclusion" name="exclusion"><?= (set_value('exclusion'))?set_value('exclusion'): $exclusion ; ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="terms">Terms & Services *</label>
                                    <textarea class="form-control required" id="terms" name="terms"><?= (set_value('terms'))?set_value('terms'): $terms ; ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="thumbnailImage">Thumbnail </label>
                                    <input type="file" name="thumbnailImage" id="thumbnailImage" size="20" accept="image/*" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="serviceImage">Service Images <small>(select multiple images)</small> </label>
                                    <input type="file" name="serviceImage[]" id="serviceImage" size="20" multiple accept="image/*" />
                                </div>
                            </div>
                            <?php 
                            //  $tooltip = "Note: The Individual Option means a discount will be applied to each child's and each adult's price separately.If Total Option is selected means a the discount amount will be applied to the total sum of all prices (child and adult)." ?>
                            <!-- <div class="col-md-3">
                                
                                <div class="form-group">
                                    <label for="discount_as" class="bg-dark" tabindex="0" data-toggle="tooltip" title="<?= $tooltip ?>"> <i class="fa fa-question text-primary"></i> Apply Discount As: </label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="discount_as" value="total" id="discount_as" <?= (($discount_as ?? '')== 'total') ?'checked' :''; ?> >
                                        <label class="form-check-label" for="discount_as" style="font-weight: 500;" >
                                            Total Price  (Child + Adult )
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="discount_as" value="ind" id="discount_as2" <?= (($discount_as ?? '')== 'ind') ?'checked' :''; ?> >
                                        <label class="form-check-label" for="discount_as2" style="font-weight: 500;" >
                                        Individual Prices (Child & Adult )
                                        </label>
                                    </div>
                                    
                                </div>
                            </div> -->
                            <!-- <div class="col-md-3">
                                <div class="form-group">
                                    <label for="apply_tax">Tax Apply</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="apply_tax" value="1" id="apply_tax" style="font-weight: 500;" <?= (($apply_tax ?? '')== '1') ? 'checked' : '' ; ?> >
                                        <label class="form-check-label" for="apply_tax1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="apply_tax" value="0"  id="apply_tax2"  style="font-weight: 500;" <?= (($apply_tax ?? '')== '0') ? 'checked' :''; ?> >
                                        <label class="form-check-label" for="apply_tax2">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <input type="submit" class="btn btn-primary" value="Submit" />
                        <input type="reset" class="btn btn-default" value="Reset" />
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>

        </div>
    </section>

</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="add_slots" id="add_slots">
            <div class="modal-body">
                <!-- Multiple slots -->
                
                    <table class="table table-bordered table-hover" id="dynamic_field">
                        <tr>
                            <td><input type="text" name="name[]"  placeholder="Enter Slot Name i.e S1" class="form-control name_list" /></td>
                            <td><input type="number" name="amount[]"  placeholder="Enter Slot Price i.e 120 " class="form-control total_amount" /></td>
                            <td><button type="button" name="add" id="add" class="btn btn-primary">Add More</button></td>
                        </tr>
                        <?php if($this->session->userdata('slot_data')){
                              $slot_data = $this->session->userdata('slot_data');
                              $i = 1;
                              
                              foreach($slot_data as $KEY => $slot){
                            ?>
                        <tr id="row<?= $i; ?>">
                            <td><input type="text" name="name[]" value="<?= $KEY ?>" placeholder="Enter Slot Name" class="form-control name_list"/></td>
                            <td><input type="number" name="amount[]" value="<?= $slot ?>" placeholder="Enter Slot Price" class="form-control total_amount"/></td>
                            <td><button type="button" name="remove" id="<?= $i; ?>" class="btn btn-danger btn_remove">X</button></td>
                        </tr>
                        <?php } } ?>
                    </table>
                    <!-- <input type="submit" class="btn btn-success" name="submit" id="submit" value="Submit"> -->
                
                <!-- End Multiple slots -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" id="submit"  class="btn btn-success">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePriceLabelA(){
       $('#priceAdultLabel').prop('disabled', (i, v) => !v);
       $('#priceAdultLabel').focus();
    }
    function togglePriceLabelC(){
       $('#priceChildLabel').prop('disabled', (i, v) => !v);
       $('#priceChildLabel').focus();
    }
    
</script>

<!-- <script src="<?= base_url() ?>assets/admin/js/common.js"></script> -->
<script>
    $(document).ready(function() {

        var selectedOption = $("#attractionType").find('option:selected');
        var dataName = selectedOption.val(); // Preferred method

        if (dataName == "slot") {
            $('#slotcount').removeAttr('disabled');
            $('#slotcount').attr('required', 'required');
        } else {
            $('#slotcount').attr('disabled', 'disabled');
            $('#slotcount').removeAttr('required');
        }

        $('#attractionType').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var dataName = selectedOption.val(); // Preferred method

            if (dataName == "slot") {
                $('#slotcount').removeAttr('disabled');
                $('#slotcount').attr('required', 'required');
            } else {
                $('#slotcount').attr('disabled', 'disabled');
                $('#slotcount').removeAttr('required');
            }

        });
    });
</script>

<script>
    var jsonString = {};
    var count = 0;
    $(document).ready(function() {

        var i = 1;
        var length;
        //var addamount = 0;
        var addamount = 0;

        $("#add").click(function() {

            //   <!-- var rowIndex = $('#dynamic_field').find('tr').length;	 -->
            //   <!-- console.log('rowIndex: ' + rowIndex); -->
            //   <!-- console.log('amount: ' + addamount); -->
            //   <!-- var currentAmont = rowIndex * 700; -->
            //   <!-- console.log('current amount: ' + currentAmont); -->
            //   <!-- addamount += currentAmont; -->

            addamount += 0;
            console.log('amount: ' + addamount);
            i++;
            $('#dynamic_field').append('<tr id="row' + i + '"><td><div class="input-group"><span class="input-group-addon" style="background: #f6f6f6 !important;"> <i class="fa fa-pencil" ></i>&nbsp<input type="text" id="bsLabel' + i + '" name="bsLabel[]" placeholder="e.g Child Seat"   value=""  style="max-width: 100px;border: none;padding: 0 5px;margin-right: -10px;" ></span><input type="text" id="bsAges" name="bsAges[]" value="" class="form-control"  placeholder="Age e.g 0-6 months"  maxlength="256" /></div></td><td><input type="number" name="bsPrice[]" value="0" placeholder="Enter Price i.e 10" class="form-control total_amount"/></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
        });

        $(document).on('click', '.btn_remove', function() {
            addamount -= 0;
            console.log('amount: ' + addamount);

            //  <!-- var rowIndex = $('#dynamic_field').find('tr').length;	 -->
            //   <!-- addamount -= (700 * rowIndex); -->
            //   <!-- console.log(addamount); -->

            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });
    });


    $(document).ready(function() {
        $('#add_slots').submit(function(event) {
            event.preventDefault(); // Prevent form submission

            var formData = $(this).serializeArray();
            var jsonData = {};

            $.each(formData, function() {
                if (jsonData[this.name]) {
                    if (!jsonData[this.name].push) {
                        jsonData[this.name] = [jsonData[this.name]];
                    }
                    jsonData[this.name].push(this.value || '');
                } else {
                    jsonData[this.name] = this.value || '';
                }
            });

            if (formData.length > "4") {
                var mergedObject = jsonData['name[]'].reduce(function(result, key, index) {
                    result[key] = jsonData['amount[]'][index];
                    return result;
                }, {});

                //     // Convert JSON object to string for demonstration
                jsonString = JSON.stringify(mergedObject);
                saveDataToSession(jsonString);
            } else {
                alert("Error! please add more fields..")
            }

        });

        function saveDataToSession(data) {
            $.ajax({
                type: 'POST',
                url: '<?= base_url(); ?>/Service/saveServiceDataToSession', // Update with your controller and method URL
                data: {
                    data: data
                },
                beforeSend: function() {
                    $('#add_slots').text('Saving...');
                },
                success: function(response) {
                    $('#slotCount').text('Total Slot (' + response + ')')
                    alert('Data saved successfully');

                    $('#add_slots').text('Save Changes');
                    // console.log('Data saved to session successfully'+ response);
                },
                error: function(xhr, status, error) {
                    $('#add_slots').text('Save Changes');
                    alert('Error saving data' + error);
                    // console.error('Error saving data to session:', error);
                }
            });
        }

    });
</script>


    <script>
        $(document).ready(function() {
            // Save data to session storage when button is clicked
            $('#saveButton').click(function() {
                console.log(jsonString);
                // var dataToSave = $('#dataInput').val();
                sessionStorage.setItem('savedData', jsonString);
                // console.log('Data saved to session storage: ' + dataToSave);
            });

            // Retrieve data from session storage when button is clicked
            $('#retrieveButton').click(function() {
                var retrievedData = sessionStorage.getItem('savedData');
                if (retrievedData) {
                    $('#displayData').text('Data retrieved from session storage: ' + retrievedData);
                } else {
                    $('#displayData').text('No data found in session storage.');
                }
            });
        });
    </script>
