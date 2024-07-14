<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Collect Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="transaction_submit" id="transaction_submit">
                <div class="modal-body">
                    <!-- Multiple slots -->

                    <table class="table table-bordered table-hover" id="dynamic_field">

                        <tr>
                            <th>Guest Name : </th>
                            <td> <?= $gName ?> </td>
                            <th>Guest Contact : </th>
                            <td> <?= $gNum ?> </td>
                        </tr>
                        <tr>
                            <th>Guest Email : </th>
                            <td> <?= "abc123@gmail.com" ?> </td>
                            <th>Payment Status : </th>
                            <td id="pay_status"><?php
                                if ($status == ACTIVE) {
                                ?> <span class="label label-success">Success</span>
                                <?php
                                } else {
                                ?> <span class="label label-warning">Pending</span> <?php
                                                                                        }
                                                                                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <h4>Transaction information</h4>
                            </td>
                        </tr>
                        <tr>
                            <th>Total Price: </th>
                            <td colspan="3">
                                <input type="hidden" name="serviceId"  value="<?=$sid?>">
                                <input type="hidden" name="bookingId"  value="<?=$bid?>">
                                <input type="hidden" name="supplierId"  value="<?=$spId?>">
                                <input type="hidden" name="guestPhone"  value="<?=$gNum?>">
                                <span disabled readonly class="form-control " ><?= $tPrice ?> AED</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Transcation Id: </th>
                            <td colspan="3"><input type="text" name="transNo" value="" placeholder="Enter Transaction id" class="form-control " required /></td>
                        </tr>

                        <tr>
                            <th>Total Amount: </th>
                            <td colspan="3"><input type="text" name="totalAmount" value="0.00" placeholder="Enter Total amount" class="form-control total_amount" required /></td>
                        </tr>

                        <tr>
                            <th>Remarks : </th>
                            <td colspan="3">
                                <textarea name="remark" id="remark" cols="30" rows="3" placeholder="Write a comment here..." class="form-control total_amount"></textarea>
                                <!-- <input type="text" name="amount" value="0.00" placeholder="Enter Total amount" class="form-control total_amount" required/></td> -->
                        </tr>
                    </table>
                    <!-- <input type="submit" class="btn btn-success" name="submit" id="submit" value="Submit"> -->

                    <!-- End Multiple slots -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" id="trans_form_submit" class="btn btn-success">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>