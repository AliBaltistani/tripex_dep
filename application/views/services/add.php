<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-user-circle-o" aria-hidden="true"></i> Services Management
            <small>Add New Service</small>
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
                <!-- end display errors -->

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Service Details for <b>( <?= $categoryInfo->categoryName; ?>)</b></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <?php echo form_open_multipart('services/add_new/' . $parms); ?>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" name="serviceLabel" value="<?= strtolower($categoryInfo->categoryLabel); ?>" required>
                                    <label for="title">Services Title *</label>
                                    <input type="text" class="form-control required" value="<?php echo set_value('title'); ?>" id="title" name="title" maxlength="256" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="role">Status</label>
                                    <select class="form-control required" id="status" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="<?= ACTIVE ?>" <?php if (set_value('status') == ACTIVE) {
                                                                            echo "selected=selected";
                                                                        } ?>>Publish</option>
                                        <option value="<?= INACTIVE ?>" <?php if (set_value('status') == INACTIVE) {
                                                                            echo "selected=selected";
                                                                        } ?>>Unpublish</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="role">Select <?= ucfirst($categoryInfo->categoryLabel); ?></label>
                                    <select class="form-control required" id="subcatId" name="subcatId" required>
                                        <option value="">Select Category</option>
                                        <?php foreach ($subcategoryInfo as $single) {  ?>
                                            <option value="<?= $single->subcatId; ?>" <?php if ($single->subcatId == set_value('subcatId')) {
                                                                                            echo "selected=selected";
                                                                                        } ?>><?= $single->subcatName; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <?php if ($categoryInfo->categoryLabel == "attraction") { include('add-attraction.php'); }
                                  else if ($categoryInfo->categoryLabel == TRANSPORT) { include('add-transport.php'); }
                              ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Overview *</label>
                                    <textarea class="form-control required" id="description" name="description"><?php echo set_value('description'); ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Inclusion">Inclusion *</label>
                                    <textarea class="form-control required" id="Inclusion" name="inclusion"><?php echo set_value('inclusion'); ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Exclusion">Exclusion *</label>
                                    <textarea class="form-control required" id="Exclusion" name="exclusion"><?php echo set_value('exclusion'); ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="terms">Terms & Services *</label>
                                    <textarea class="form-control required" id="terms" name="terms"><?php echo set_value('terms'); ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="thumbnailImage">Thumbnail *</label>
                                    <input type="file" name="thumbnailImage" id="thumbnailImage" size="20" accept="image/*" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="serviceImage">Service Images <small>(select multiple images)</small> </label>
                                    <input type="file" name="serviceImage[]" id="serviceImage" size="20" multiple accept="image/*" />
                                </div>
                            </div>
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
                
                <button type="submit" name="submit" id="submit"  class="btn btn-success">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>assets/admin/js/common.js"></script>
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
            $('#dynamic_field').append('<tr id="row' + i + '"><td><input type="text" name="name[]" placeholder="Enter Slot Name" class="form-control name_list"/></td><td><input type="number" name="amount[]" value="0" placeholder="Enter Slot Price" class="form-control total_amount"/></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
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

            if(formData.length > "4"){
                var mergedObject = jsonData['name[]'].reduce(function(result, key, index) {
                result[key] = jsonData['amount[]'][index];
                return result;   
                }, {});

                //     // Convert JSON object to string for demonstration
                jsonString = JSON.stringify(mergedObject);
                saveDataToSession(jsonString);
              }else{
                alert("Error! please add more fields..")
              }
        
        });

        function saveDataToSession(data) {
            $.ajax({
                type: 'POST',
                url: '<?= base_url(); ?>/Service/saveServiceDataToSession', // Update with your controller and method URL
                data: { data: data },
                beforeSend: function(){
                    $('#add_slots').text('Saving...');
                },
                success: function(response) {
                    $('#slotCount').text('Total Slot ('+response+')')
                    alert('Data saved successfully');
                    
                    $('#add_slots').text('Save Changes');
                    // console.log('Data saved to session successfully'+ response);
                },
                error: function(xhr, status, error) {
                    $('#add_slots').text('Save Changes');
                    alert('Error saving data'+ error);
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
