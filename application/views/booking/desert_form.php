<div class="col-md-12">
              <!-- general form elements -->
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Booking Details for <strong>(<?= $sTitle; ?>)</strong></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addBooking" action="<?php echo base_url('booking/addNewBooking?type='.$cLabel.$params) ?>" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <!-- <div class="col-md-6">                                
                                    <div class="form-group"> -->
                                        <!-- <label for="vCode">Vehicle Code</label> -->
                                        <input type="hidden" class="form-control required" value="<?php echo (set_value('vCode')) ? set_value('vCode') : $vCode ; ?>" id="vCode" name="vCode" maxlength="256" />
                                    <!-- </div> 
                                </div>
                                <div class="col-md-3">                                
                                    <div class="form-group"> -->
                                        <!-- <label for="staff">Staff</label> -->
                                        <input type="hidden" class="form-control required" value="<?= (set_value('staff')) ? set_value('staff') :'COMPANY'; ?>" id="staff" name="staff" required />
                                    <!-- </div> 
                                </div> -->
                                <!-- <div class="col-md-3">                                
                                    <div class="form-group"> -->
                                        <!-- <label for="agent">Agent</label> -->
                                        <input type="hidden" class="form-control required" value="<?= (set_value('staff')) ? set_value('agent') :'Online Booking'; ?>" id="agent" name="agent" required />
                                    <!-- </div> 
                                </div> -->

                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="bTour">Tour</label>
                                        <input type="text" class="form-control required" value="<?= (set_value('bTour')) ? set_value('bTour') :'DUBAI '. str_replace('-',' ',$type); ?>" id="bTour" name="bTour" required />
                                    </div> 
                                </div>
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="bType">Type</label>
                                        <input type="text" class="form-control required" value="<?= (set_value('bType')) ? set_value('bType') :'PVT'; ?>" id="bType" name="bType" required />
                                    </div> 
                                </div>
                                
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="cName">Cutomer Name</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('cName'); ?>" id="cName" name="cName" maxlength="256" />
                                    </div> 
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="cEmail">Cutomer Email</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('cEmail'); ?>" id="cEmail" name="cEmail" maxlength="256" />
                                    </div> 
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="cPh">Cutomer Phone Number</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('cPh'); ?>" id="cPh" name="cPh" maxlength="20" />
                                    </div> 
                                </div>
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="puDate">Select Your Travel Date:</label>
                                        <input type="date" class="form-control required" value="<?php echo set_value('puDate'); ?>" id="puDate" name="puDate" />
                                    </div> 
                                </div>
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="puDate">Transfer Options::</label>
                                        <select class="form-control required"  name="transfer_option" id="transfer_option" onchange="changePriceStatus(this)" >
                                            <option value="without-transfers">Without Transfers</option>
                                            <option value="private-transfers">Private Transfers</option>
                                        </select>
                                    </div> 
                                </div>
                                <!-- <div class="col-md-3">                                
                                    <div class="form-group"> -->
                                        <!-- <label for="puTime">Select Pickup Time</label> -->
                                        <input type="hidden" class="form-control required" value="<?php echo set_value('puTime'); ?>" id="puTime" name="puTime" />
                                    <!-- </div> 
                                </div> -->
                                <!-- <div class="col-md-3">                                
                                    <div class="form-group"> -->
                                        <!-- <label for="puLoc">Enter Pickup Location</label> -->
                                        <input type="hidden" class="form-control required" value="<?php echo set_value('puLoc'); ?>" id="puLoc" name="puLoc" />
                                    <!-- </div> 
                                </div> -->
                                <!-- <div class="col-md-3">                                
                                    <div class="form-group"> -->
                                        <!-- <label for="drpLoc">Enter Drop Off Location</label> -->
                                        <input type="hidden" class="form-control required" value="<?php echo set_value('drpLoc'); ?>" id="drpLoc" name="drpLoc" />
                                    <!-- </div> 
                                </div> -->
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="noOfPerson">Adult</label>
                                        <input type="number" onkeyup="updatePrice()" onchange="updatePrice()" class="form-control required" value="<?=  (set_value('noOfPerson'))?set_value('noOfPerson') : 0 ; ?>" id="noOfPerson" name="noOfPerson" min="0" max="<?= (int)$passengers ?>" required />
                                    </div> 
                                </div>
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="noOfPerson">Child</label>
                                        <input type="number" onkeyup="updatePrice()" onchange="updatePrice()" class="form-control required" value="<?=  (set_value('babySeat'))?set_value('noOfPerson') : 0 ; ?>" id="babySeat" name="babySeat" min="0" max="<?= (int)$passengers ?>" required />
                                    </div> 
                                </div>
                                <!-- <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label >Baby Seat Option </label>
                                        <br>
                                        <input type="checkbox" onclick="updatePrice()" <?= (set_value('babySeat'))?'checked' : '' ; ?>  id="babySeat" name="babySeat" value="1" />
                                        <span for="babySeat">Add Baaby Seat ?</span>
                                    </div> 
                                </div> -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Add Service Details</label>
                                        <textarea class="form-control required" id="description" name="description"> <?= (set_value('description'))?set_value('description') : $sTitle ; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Review:</label>
                                        <textarea class="form-control required" id="sp_note" name="sp_note"> <?= (set_value('sp_note'))?set_value('sp_note') : $sp_note ?? '' ; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="totalPriceInput">Total Price (AED)</label>
                                        <input type="number" class="form-control required" value="<?= (set_value('totalPriceInput'))?set_value('totalPriceInput') : '0.00' ; ?>" id="totalPriceInput" name="totalPriceInput" min="0" required />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="totalPriceInput">Flight No:</label>
                                        <input type="number" class="form-control required" value="<?= (set_value('flight_no'))?set_value('flight_no') : '' ; ?>" id="flight_no" name="flight_no" min="0" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="totalPriceInput">Arrival/Departure Time</label>
                                        <input type="number" class="form-control required" value="<?= (set_value('ad_time'))?set_value('ad_time') : '' ; ?>" id="ad_time" name="ad_time" min="0" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pay_method"> Payment Method </label>
                                        <select class="form-control required" id="pay_method" name="pay_method" required>
                                            <option value="" selected disabled>Select Method</option>      
                                            <option value="online-payment" <?= (set_value('pay_method') == 'online-payment') ? 'selected' :''; ?> >Online Payment</option>  
                                        </select>
                                    </div>
                                </div>
                                
                                <input type="hidden" name="pay_status" value="<?=INACTIVE?>" >

                                
                                <!-- <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="supplierName"> Supplier Detail </label>
                                        <input type="text" class="form-control required" value="" id="supplierName" name="supplierName"  readonly />
                                        <input type="hidden"  class="form-control required" value="" id="supplierId" name="supplierId"  readonly />
                                    </div>
                                </div> -->
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <!-- <input type="reset" class="btn btn-default" value="Reset" /> -->
                        </div>
                    </form>
                </div>
            </div>


            <script>
    // $(document).ready(function() {

        var adultPrice = '<?php echo $pAdult; ?>' // Price for each adult
        var adultPriceTotal = '<?php echo $pAdult; ?>' // Price for each adult
        var childPriceTotal = '<?php echo  $pChild; ?>' // Price for each adult
        var childPrice = '<?php echo  $pChild; ?>'; // Price for each child
        var total_capacity = '<?php echo  $passengers; ?>'; // Price for each child
        var numAdults = 0;
        var numChildren = 0;
        var totalPrice = 0;

        var totalBsPrice = 0;
        var addBabySeatPrice = false;
        var transportTax = '<?php echo $trspTax ?? 0; ?>';

        // Function to update total price
        function updateTotalPrice() {
            totalPrice = parseFloat(totalBsPrice) + ((parseInt(numAdults) * parseInt(adultPrice)) + ((parseInt(numChildren) * parseInt(childPrice))));
            const typeTrs = $('#transfer_option').find(':selected').val();
            if(typeTrs.trim() == 'private-transfers' && (numAdults > 0 || numChildren > 0) ){
                transportTax = isNaN(transportTax) ? 0 : transportTax;
                totalPrice = parseFloat(totalPrice) + parseInt(transportTax)
            }

            $("#totalPrice").text(totalPrice + " AED");
            $("#totalPrice_hidden").val(totalPrice + " AED");
        }

       function changePriceStatus(e){
        updateTotalPrice();
            // updateTotalPrice();
        }

        // Function to update Adult total price
        function updateTotalPriceAdult() {
            var adultPriceTotal = (adultPrice * numAdults);
            $("#total_price_adult").text(adultPriceTotal + " AED");
        }
        // Function to update Child total price
        function updateTotalPriceChild() {
            var childPriceTotal = (childPrice * numChildren);
            $("#total_price_child").text(childPriceTotal + " AED");
        }

        // Add adult
        $("#quantity_plus_adult").click(function(e) {
            e.preventDefault();
            quantityAdult = $("#quantity_input_adult").val();
            value = parseInt(quantityAdult)
            $("#quantity_input_adult").val((value + 1));
            quantityAdult = $("#quantity_input_adult").val();

            if (quantityAdult >= 0) {
                numAdults = quantityAdult;
            } else {
                numAdults = 0
            }
            updateTotalPrice();
            $("#quantity_span_adult").text(quantityAdult);
            updateTotalPriceAdult();

        });

        // Subtract adult
        $("#quantity_minus_adult").click(function(e) {
            e.preventDefault();
            quantityAdult = $("#quantity_input_adult").val();

            if (quantityAdult > 0) {
                value = parseInt(quantityAdult)
                $("#quantity_input_adult").val((value - 1));
            }
            quantityAdult = $("#quantity_input_adult").val();

            if (quantityAdult <= 0) {
                numAdults = 0;
            } else {
                numAdults = quantityAdult
            }

            if (quantityAdult >= 0) {
                // numAdults = quantityAdult;
                updateTotalPrice();
                $("#quantity_span_adult").text(quantityAdult);
                updateTotalPriceAdult();
            }
        });

 
        // Add child
        $("#quantity_minus_child").click(function(e) {

            e.preventDefault();
            quantitychild = $("#quantity_input_child").val();
            if (quantitychild > 0) {
                value = parseInt(quantitychild)
                $("#quantity_input_child").val((value - 1));
            }
            quantitychild = $("#quantity_input_child").val();

            if (quantitychild <= 0) {
                numChildren = 0;
            } else {
                numChildren = quantitychild
            }

            updateTotalPrice();
            $("#quantity_span_child").text(quantitychild);
            updateTotalPriceChild();
        });

        // add child
        $("#quantity_plus_child").click(function(e) {
            e.preventDefault();
            quantitychild = $("#quantity_input_child").val();
            value = parseInt(quantitychild)
            $("#quantity_input_child").val((value + 1));
            quantitychild = $("#quantity_input_child").val();

            if (quantitychild >= 0) {
                numChildren = quantitychild
            } else {
                numChildren = 0;
            }
            if (quantitychild > 0) {
                ;

                updateTotalPrice();

                $("#quantity_span_child").text(quantitychild);
                updateTotalPriceChild();
            }
        });

        // 		baby Seat price add
        // $("#baby_seat").click(function() {
        //     baby_seat = $('#baby_seat').is(':checked');

        //     if (baby_seat) {
        //         addBabySeatPrice = true;
        //     } else {

        //         addBabySeatPrice = false;
        //     }

        //     updateTotalPrice();
        // });

    // });
</script>
<!--end prices-->

<script>
    function getCheckedCheckboxes() {
        var checkboxes = document.querySelectorAll('.slots');
        var checkedCheckboxes = [];

        var i = 0;
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                i++;
                checkedCheckboxes.push(parseInt(checkbox.value));
                // checkedCheckboxes = checkbox.value;
            }
        });

        var jsonArray = JSON.stringify(checkedCheckboxes);

        if (checkedCheckboxes) {
            var sum = sumArray(checkedCheckboxes);
            // var s = document.getElementById('slot_no');
            // s.value = jsonArray;
            alert(sum);
        }

    }

    function sumArray(array) {
        return array.reduce(function(accumulator, currentValue) {
            return accumulator + currentValue;
        }, 0); // Start with an initial value of 0
    }

    function validateSlot() {
        document.querySelectorAll('.button_slots').forEach(button => {
            button.addEventListener('click', function() {
                // Toggle between 'success' and 'info' classes for all buttons
                document.querySelectorAll('.button_slots').forEach(button => {

                    this.classList.toggle("btn-danger");
                    if (this.classList.contains("btn-info")) {
                        this.classList.remove("btn-info");
                        this.classList.add("btn-danger");
                        // alert($(this).data('price'))
                        // getCheckedCheckboxes();
                    } else if (button.classList.contains("btn-danger")) {
                        button.classList.remove("btn-danger");
                        button.classList.add("btn-info");
                    }

                });

            });


        });
    }

    

    validateSlot();
</script>