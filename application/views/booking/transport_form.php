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
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="vCode">Vehicle Code</label>
                                        <input type="text" class="form-control required" value="<?php echo (set_value('vCode')) ? set_value('vCode') : $vCode ; ?>" id="vCode" name="vCode" maxlength="256" />
                                    </div> 
                                </div>
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="staff">Staff</label>
                                        <input type="text" class="form-control required" value="<?= (set_value('staff')) ? set_value('staff') :'COMPANY'; ?>" id="staff" name="staff" required />
                                    </div> 
                                </div>
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="agent">Agent</label>
                                        <input type="text" class="form-control required" value="<?= (set_value('staff')) ? set_value('agent') :'Online Booking'; ?>" id="agent" name="agent" required />
                                    </div> 
                                </div>

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
                                        <label for="puDate">Select Pickup date</label>
                                        <input type="date" class="form-control required" value="<?php echo set_value('puDate'); ?>" id="puDate" name="puDate" />
                                    </div> 
                                </div>
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="puTime">Select Pickup Time</label>
                                        <input type="time" class="form-control required" value="<?php echo set_value('puTime'); ?>" id="puTime" name="puTime" />
                                    </div> 
                                </div>
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="puLoc">Enter Pickup Location</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('puLoc'); ?>" id="puLoc" name="puLoc" />
                                    </div> 
                                </div>
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="drpLoc">Enter Drop Off Location</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('drpLoc'); ?>" id="drpLoc" name="drpLoc" />
                                    </div> 
                                </div>
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <label for="noOfPerson">No of Participant Max : (<?= $passengers; ?>)</label>
                                        <input type="number" onkeyup="updatePrice()" onchange="updatePrice()" class="form-control required" value="<?=  (set_value('noOfPerson'))?set_value('noOfPerson') : 0 ; ?>" id="noOfPerson" name="noOfPerson" min="0" max="<?= (int)$passengers ?>" required />
                                    </div> 
                                </div>
                                <div class="col-md-3">                                
                                    <div class="form-group">
                                        <!-- <input  name="" id=""> -->
                                        <label >Baby Seat Option </label>
                                        <br>
                                        <input type="checkbox" onclick="updatePrice()" <?= (set_value('babySeat'))?'checked' : '' ; ?>  id="babySeat" name="babySeat" value="1" />
                                        <span for="babySeat">Add Baaby Seat ?</span>
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Add Service Details</label>
                                        <textarea class="form-control required" id="description" name="description"> <?= (set_value('description'))?set_value('description') : $sTitle ; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="totalPriceInput"> Total Price (AED)</label>
                                        <input type="number" class="form-control required" value="<?= (set_value('totalPriceInput'))?set_value('totalPriceInput') : '0.00' ; ?>" id="totalPriceInput" name="totalPriceInput" min="0" readonly required />
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

//price calculation start here
     var    countPrice = 0.00;
     var    totlPrice = <?= $pChild + $pAdult;  ?>;
     var    countPrice = totlPrice;
     var    addBabySeat = false;
     var    numAdutl  = 0;
     
    function updatePrice(){
        
        var baby_seat = $('#babySeat').is(':checked');
        var noOfPerson = document.querySelector("#noOfPerson").value;
        
            countPrice = (totlPrice * 0);

            if(noOfPerson != 0 ){
                countPrice = (totlPrice * 1)
            }
            if(baby_seat){
             countPrice = (countPrice + 25)
            }
            
            document.querySelector("#totalPriceInput").value = countPrice ;
    }

//price calculation ended here
    
</script>