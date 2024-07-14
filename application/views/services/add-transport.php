<!--<div class="col-md-3">-->
<!--    <div class="form-group">-->
<!--        <label for="priceAdult">Price *</label>-->
<!--        <input type="hidden" class="form-control required" value="0.00" id="priceChild" name="priceChild" maxlength="256" />-->
<!--        <input type="number" class="form-control required" value="<?php echo set_value('priceAdult'); ?>" id="priceAdult" name="priceAdult" maxlength="256" />-->
<!--    </div>-->
<!--</div>-->
<div class="col-md-3">
    <label for="priceAdult">Price for Adult (AED) * </label>
    <div class="input-group"> 
      <span class="input-group-addon" style="background: #f6f6f6;!important"> <i class="fa fa-pencil" ></i>&nbsp
       <input type="text" name="priceAdultLabel" id="priceAdultLabel" value=" <?= (set_value('priceAdultL')) ? set_value('priceAdultL') : '(8 years +)'; ?>"  style="max-width: 100px;border: none;padding: 0 5px;margin-right: -10px;" >
      </span>
      <input type="number" class="form-control required" value="<?php echo set_value('priceAdult'); ?>" id="priceAdult" name="priceAdult" maxlength="256" />
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label for="priceChild">Price for Child (AED) *</label>
         <div class="input-group"> 
          <span class="input-group-addon" style="background: #f6f6f6;!important"> <i class="fa fa-pencil"   ></i>&nbsp
           <input type="text" name="priceChildLabel" id="priceChildLabel" value=" <?= (set_value('priceChildL')) ? set_value('priceChildL') : '(3 to 8 years)'; ?>"  style="max-width: 100px;border: none;padding: 0 5px;margin-right: -10px;" >
          </span>
          <input type="number" class="form-control required" id="priceChild" name="priceChild" value="<?php echo set_value('priceChild'); ?>" />
        </div>
        
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label for="vehicleCode">Vehicle Code</label>
        <input type="text" class=" form-control required" id="vehicleCode" name="vehicleCode" value="<?php echo set_value('vehicleCode'); ?>" />

    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label for="type"><?= ucfirst($categoryInfo->categoryLabel); ?> Type</label>
    
        <select class="form-control required" id="type" name="type" required>
            <option value="">Select Type</option>
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
