<div class="col-md-3">
   <div class="form-group">
       <label for="priceAdult">Price for Adult (AED) <span style="color: red;">*</span></label>
       <input type="number" class="form-control required" value="<?php echo (set_value('priceAdult')) ? set_value('priceAdult') : $pAdult; ?>" id="priceAdult" name="priceAdult" maxlength="256" />
   </div>
</div>
<div class="col-md-3">
<div class="form-group">
       <label for="priceAdult">Price for Child (AED) <span style="color: red;">*</span></label>
       <input type="number" class="form-control required" value="<?php  echo (set_value('priceChild')) ? set_value('priceChild') : $pChild; ?>" id="priceChild" name="priceChild" maxlength="256" />
   </div>
</div>

<!-- <div class="col-md-3">
    <div class="form-group">
        <label for="vehicleCode">Vehicle Code <span style="color: red;">*</span></label> -->
        <input type="hidden" class=" form-control required" id="vehicleCode" name="vehicleCode" value="null" />
        <input type="hidden" class=" form-control required" id="type" name="type" value="null" />
    <!-- </div>
</div> -->


<!-- <div class="col-md-3">
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
</div> -->


<div class="col-md-6">
    <div class="form-group">
        <label for="transportTax">Transportation Rates (If Any)</label>
        <input type="number" class=" form-control required" id="transportTax" name="transportTax" value="<?php  echo (set_value('transportTax')) ? set_value('transportTax') : $transportTax; ?>" />
    </div>
</div>
