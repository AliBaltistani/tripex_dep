<!--<div class="col-md-3">-->
<!--    <div class="form-group">-->
<!--        <label for="priceAdult">Price *</label>-->
<!--        <input type="hidden" class="form-control required" value="0.00" id="priceChild" name="priceChild" maxlength="256" />-->
<!--        <input type="number" class="form-control required" value="" id="priceAdult" name="priceAdult" maxlength="256" />-->
<!--    </div>-->
<!--</div>-->

<div class="col-md-6">
    <label for="priceAdult">Price for Adult (AED) * </label>
    <input type="hidden" name="priceChildLabel" id="priceChildLabel" value=""  style="max-width: 100px;border: none;padding: 0 5px;margin-right: -10px;" >
    <input type="hidden" class="form-control required" id="priceChild" name="priceChild" value="0.00" />

    <div class="input-group"> 
      <span class="input-group-addon" style="background: #f6f6f6!important;"> <i class="fa fa-pencil"  ></i>&nbsp
       <input type="text" name="priceAdultLabel" id="priceAdultLabel" value="<?= (set_value('priceAdultL')) ? set_value('priceAdultL') : $pAdultL ?? '(8 years +)'; ?>" style="max-width: 100px;border: none;padding: 0 5px;margin-right: -10px;" >
      </span>
      <input type="number" class="form-control required" value="<?= (set_value('priceAdult'))?set_value('priceAdult'): $pAdult; ?>" id="priceAdult" name="priceAdult" maxlength="256" />
    </div>
</div>

<!-- <div class="col-md-3">
    <div class="form-group">
        <label for="priceChild">Price for Child (AED) *</label>
         <div class="input-group"> 
          <span class="input-group-addon" style="background: #f6f6f6;!important"> <i class="fa fa-pencil"  ></i>&nbsp
           <input type="text" name="priceChildLabel" id="priceChildLabel" value=" <?= (set_value('priceChildL')) ? set_value('priceChildL') : $pChildL ?? '(3 to 8 years)'; ?>"  style="max-width: 100px;border: none;padding: 0 5px;margin-right: -10px;" >
          </span>
          <input type="number" class="form-control required" id="priceChild" name="priceChild" value="<?= (set_value('priceChild'))?set_value('priceChild'): $pChild ?? ''; ?>" />
        </div>
        
    </div>
</div> -->

<div class="col-md-3">
    <div class="form-group">
        <label for="vehicleCode">Vehicle Code</label>
        <input type="text" class=" form-control required" id="vehicleCode" name="vehicleCode" value="<?= (set_value('vehicleCode'))?set_value('vehicleCode'): $vCode; ?>" />

    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label for="type"><?= ucfirst($cLabel); ?> Type</label>
    
        <select class="form-control required" id="type" name="type" required>
            <option value="">Select Type</option>
            <option value="full-day" <?php if (set_value('type') == "full-day" || $type == "full-day") {
                                            echo "selected=selected";
                                        } ?>>Full Day (DUBAI City Tour)</option>
            <option value="half-day" <?php if (set_value('type') == "half-day" || $type == "half-day") {
                                            echo "selected=selected";
                                        } ?>>Half Day (DUBAI City Tour)</option>
            <option value="arrival" <?php if (set_value('type') == "arrival" || $type == "arrival") {
                                        echo "selected=selected";
                                    } ?>> Arrival </option>
            <option value="departure" <?php if (set_value('type') == "departure" || $type == "departure") {
                                            echo "selected=selected";
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
                        <input type="text" id="bsLabel" name="bsLabel[]"  value="<?= $babySeatOp->bsLabel[0] ?? ''; ?>"  style="max-width: 100px;border: none;padding: 0 5px;margin-right: -10px;" >
                        </span>
                        <input type="text" id="bsAges" name="bsAges[]" value="<?= $babySeatOp->bsAges[0] ?? ''; ?>" class="form-control"  placeholder="Age e.g 0-6 months"  maxlength="256" />
                    </div>
                </td>
                <td><input type="number" name="bsPrice[]" value="<?= $babySeatOp->bsPrice[0] ?? ''; ?>" class="form-control" placeholder="Enter Price i.e 10 "  /></td>
                <td><button type="button" name="add" id="add" class="btn btn-primary">Add More</button></td>
            </tr>
            <?php  if ($babySeatOp){
                 $bsLen = count($babySeatOp->bsLabel);
             for($i = 1; $i < $bsLen; $i++) { ?>
                <tr id="row<?= $i; ?>">
                        <td>
                            <div class="input-group"> 
                                <span class="input-group-addon" style="background: #f6f6f6 !important;"> <i class="fa fa-pencil" ></i>&nbsp
                                <input type="text" id="bsLabel" name="bsLabel[]"  value="<?= $babySeatOp->bsLabel[$i] ?? ''; ?>"  style="max-width: 100px;border: none;padding: 0 5px;margin-right: -10px;" >
                                </span>
                                <input type="text" id="bsAges" name="bsAges[]" value="<?= $babySeatOp->bsAges[$i] ?? ''; ?>" class="form-control"  placeholder="Age e.g 0-6 months"  maxlength="256" />
                            </div>
                        </td>
                        <td><input type="number" name="bsPrice[]" value="<?= $babySeatOp->bsPrice[$i] ?? ''; ?>" class="form-control" placeholder="Enter Price i.e 10 "  /></td>
                        <td><button type="button" name="remove" id="<?= $i; ?>" class="btn btn-danger btn_remove">X</button></td>
                </tr>
            <?php }  } 
            ?>
        </table>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="transportTax">Transportation Tax (If Any)</label>
        <input type="number" class=" form-control required" id="transportTax" name="transportTax" value="<?php echo $transportTax ?? ''; ?>" />
    </div>
</div>

