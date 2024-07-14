<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> User Management
            <small>Add / Edit User</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->



                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter User Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addUser" action="<?php echo base_url() ?>addNewUser" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">Full Name</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('fname'); ?>" id="fname" name="fname" maxlength="128">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="text" class="form-control required email" id="email" value="<?php echo set_value('email'); ?>" name="email" maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control required" id="password" name="password" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpassword">Confirm Password</label>
                                        <input type="password" class="form-control required equalTo" id="cpassword" name="cpassword" maxlength="20">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number</label>
                                        <input type="text" class="form-control required digits" id="mobile" value="<?php echo set_value('mobile'); ?>" name="mobile" maxlength="16">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role" id="feedback" >Role () </label>
                                        <select class="form-control required" id="role" onchange="getRoleType(this.value)" name="role">
                                            <option value="0">Select Role</option>
                                            <?php
                                            if (!empty($roles)) {
                                                foreach ($roles as $rl) {
                                                    $roleText = $rl->role;
                                                    $roleClass = false;
                                                    if ($rl->roleStatus == INACTIVE) {
                                                        $roleText = $rl->role . ' (Inactive)';
                                                        $roleClass = true;
                                                    }
                                            ?>
                                                    <option value="<?php echo $rl->roleId ?>" <?php if ($roleClass) {
                                                                                                    echo "class=text-warning";
                                                                                                }
                                                                                                if ($rl->roleId == set_value('role')) {
                                                                                                    echo "selected=selected";
                                                                                                } ?>><?= $roleText ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- <div class="form-group">
                                        <label >User Type</label>
                                        <select class="form-control required"  name="isAdmin">
                                            <option value="">Select type</option>
                                            <option value="<?= SYSTEM_ADMIN ?>">System Administrator</option>
                                            <option value="<?= AGENT_USER ?>"> Agent | Agencies</option>
                                            <option value="<?= REGULAR_USER ?>">Normal User</option>
                                            <option value="<?= SUPPLIER_USER ?>"> Supplier</option>
                                        </select>
                                    </div> -->
                                </div>
                                <div class="col-md-6">
                                    <input type="hidden" class="form-control required" name="isAdmin" id="isAdmin" value="" required>
                                </div>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <a href="<?= base_url('userListing') ?>" class="btn btn-default">Back</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
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
    </section>

</div>
<script src="<?php echo base_url(); ?>assets/admin/js/addUser.js" type="text/javascript"></script>

<script>
    function getRoleType(role) {
        const roleid = role;

        $.ajax({
            type: 'POST',
            url: '<?= base_url() ?>Roles/getRoleType',
            data: {
                role_id: roleid
            },
            dataType: 'json',
            beforeSend: function() {
                $('#feedback').html(" Role <small class='text-info'> ( loading..)  ) </small> ");
            },
            success: function(response) {
                // console.log(response);
                $("#isAdmin").val("");
                if(response.status == true && response.data.role_type != 0){
                    $("#isAdmin").val( response.data.role_type);
                }else {
                    $("#isAdmin").val("");
                }
                $('#feedback').html(" Role <small class='text-success'> ( " + response.data.role + " )</small> ");
            },
            error: function(xhr, status, error) {
                $('#feedback').html( " Role <small class='text-danger'> ( "+ xhr.status + " Error: " + xhr.error + " )</small>" );
                console.error(xhr.responseText);
            }
        }); // end ajax
    }
</script>