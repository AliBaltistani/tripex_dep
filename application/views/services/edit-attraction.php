
<div class="col-md-3">
    <label for="priceAdult">Price for Adult (AED) * </label>
    <div class="input-group"> 
      <span class="input-group-addon" style="background: #f6f6f6;!important"> <i class="fa fa-pencil"  ></i>&nbsp
       <input type="text" name="priceAdultLabel" id="priceAdultLabel" value=" <?= (set_value('priceAdultL')) ? set_value('priceAdultL') : $pAdultL ?? '(8 years +)'; ?>"  style="max-width: 100px;border: none;padding: 0 5px;margin-right: -10px;" >
      </span>
      <input type="number" class="form-control required" value="<?php echo $pAdult; ?>" id="priceAdult" name="priceAdult" maxlength="256" />
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label for="priceChild">Price for Child (AED) *</label>
         <div class="input-group"> 
          <span class="input-group-addon" style="background: #f6f6f6;!important"> <i class="fa fa-pencil" ></i>&nbsp
           <input type="text" name="priceChildLabel" id="priceChildLabel" value=" <?= (set_value('priceChildL')) ? set_value('priceChildL') : $pChildL ?? '(3 to 8 years)'; ?>"  style="max-width: 100px;border: none;padding: 0 5px;margin-right: -10px;" >
          </span>
          <input type="number" class="form-control required" id="priceChild" name="priceChild" value="<?php echo $pChild; ?>" />
        </div>
        
    </div>
</div>


<!--<div class="col-md-3">-->
<!--    <div class="form-group">-->
<!--        <label for="priceAdult">Price for Adult *</label>-->
<!--        <input type="number" class="form-control required" value="<?= (set_value('priceAdult'))?set_value('priceAdult'): $pAdult; ?>" id="priceAdult" name="priceAdult" maxlength="256" />-->
<!--        <input type="hidden" class="form-control " value="NULL" id="vehicleCode" name="vehicleCode" maxlength="256" />-->
<!--    </div>-->
<!--</div>-->
<!--<div class="col-md-3">-->
<!--    <div class="form-group">-->
<!--        <label for="priceChild">Price for Child *</label>-->
<!--        <input type="number" class="form-control required" id="priceChild" name="priceChild" value="<?= (set_value('priceChild'))?set_value('priceChild'): $pChild; ?>" />-->
<!--    </div>-->
<!--</div>-->

<div class="col-md-3">
    <div class="form-group">
        <label for="attractionType"><?= ucfirst($cLabel); ?> Type</label>
        <select class="form-control required" id="attractionType" name="type" required>
            <option value="">Select Type</option>
            <option value="frame" <?php if (set_value('type') == "frame" || $type == "frame") {
                                        echo "selected=selected";
                                    } ?>>Frame</option>
            <option value="slot" <?php if (set_value('type') == "slot" || $type == "slot") {
                                        echo "selected=selected";
                                    } ?>>Slot</option>
        </select>
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label for="slotcount" id="slotCount">Total Slot (<?= ($this->session->userdata('slot_data')) ? count((array)$_SESSION['slot_data']) : '0'; ?>)</label>
        <!-- <input type="hidden" class=" form-control required" name="slotcount" value="<?php echo set_value('slotcount'); ?>" /> -->
        <!-- Button trigger modal -->
        <!-- <input type="hidden" name="supplier" value="<?= "null" ?>"> -->
        <br>
        <button type="button" id="slotcount" class="btn btn-primary" data-toggle="modal" disabled data-target="#exampleModal">
            Add Slots
        </button>
    </div>
</div>
