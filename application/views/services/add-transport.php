<!--<div class="col-md-3">-->
<!--    <div class="form-group">-->
<!--        <label for="priceAdult">Price *</label>-->
<!--        <input type="hidden" class="form-control required" value="0.00" id="priceChild" name="priceChild" maxlength="256" />-->
<!--        <input type="number" class="form-control required" value="<?php echo set_value('priceAdult'); ?>" id="priceAdult" name="priceAdult" maxlength="256" />-->
<!--    </div>-->
<!--</div>-->
<!-- <div class="col-md-3">
    <div class="form-group">
        <label for="priceChild">Price for Child (AED) <span style="color: red;">*</span></label>
         <div class="input-group"> 
          <span class="input-group-addon" style="background: #f6f6f6!important;"> <i class="fa fa-pencil"   ></i>&nbsp
          </span>
        </div>
        
    </div>
</div> -->
<div class="col-md-6">
    <label for="priceAdult">Price for Adult (AED) <span style="color: red;">*</span> </label>
    <input type="hidden" name="priceChildLabel" id="priceChildLabel" value=""  style="max-width: 100px;border: none;padding: 0 5px;margin-right: -10px;" >
    <input type="hidden" class="form-control required" id="priceChild" name="priceChild" value="0.00" />

    <div class="input-group"> 
      <span class="input-group-addon" style="background: #f6f6f6 !important;"> <i class="fa fa-pencil" ></i>&nbsp
       <input type="text" name="priceAdultLabel" id="priceAdultLabel" placeholder="e.g (8 years +)"  value="<?= (set_value('priceAdultL')) ? set_value('priceAdultL') : ''; ?>"  style="max-width: 100px;border: none;padding: 0 5px;margin-right: -10px;" >
      </span>
      <input type="number" class="form-control required" value="<?php echo set_value('priceAdult'); ?>" id="priceAdult" name="priceAdult" maxlength="256" />
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="vehicleCode">Vehicle Code <span style="color: red;">*</span></label>
        <input type="text" class=" form-control required" id="vehicleCode" name="vehicleCode" value="<?php echo set_value('vehicleCode'); ?>" />

    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label for="type"><?= ucfirst($categoryInfo->categoryLabel); ?> Type <span style="color: red;">*</span></label>
    
        <select class="form-control required" id="type" name="type" required>
            <option value="">Select Type </option>
            <option value="full-day" <?php if (set_value('type') == "full-day") {
                                            echo "selected='selected'";
                                        } ?>>Full Day (DUBAI City Tour)</option>
            <option value="half-day" <?php if (set_value('type') == "half-day") {
                                            echo "selected='selected'";
                                        } ?>>Half Day (DUBAI City Tour)</option>
            <option value="arrival" <?php if (set_value('type') == "arrival") {
                                        echo "selected='selected'";
                                    } ?>> Arrival </option>
            <option value="departure" <?php if (set_value('type') == "departure") {
                                            echo "selected='selected'";
                                        } ?>>Departure</option>

        </select>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="priceChild">Add Baby Seats </label>
           <!-- Multiple Options -->
        <table class="table table-bordered table-hover" id="dynamic_field">
            <tr>
                <td>
                    <div class="input-group"> 
                        <span class="input-group-addon" style="background: #f6f6f6 !important;"> <i class="fa fa-pencil" ></i>&nbsp
                        <input type="text" id="bsLabel" name="bsLabel[]" placeholder="e.g Child Seat"  value="<?= (set_value('bsLabel')) ? set_value('bsLabel') : ''; ?>"  style="max-width: 100px;border: none;padding: 0 5px;margin-right: -10px;" >
                        </span>
                        <input type="text" id="bsAges" name="bsAges[]" value="" class="form-control"  placeholder="Age e.g 0-6 months"  maxlength="256" />
                    </div>
                </td>
                <td><input type="number" name="bsPrice[]" value="" class="form-control" placeholder="Enter Price i.e 10 "  /></td>
                <td><button type="button" name="add" id="add" class="btn btn-primary">Add More</button></td>
            </tr>
            
        </table>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="transportTax">Transportation Rates (If Any)</label>
        <input type="number" class=" form-control required" id="transportTax" name="transportTax" value="<?php echo set_value('transportTax'); ?>" />
    </div>
</div>
