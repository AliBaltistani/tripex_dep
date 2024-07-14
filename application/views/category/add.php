<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-user-circle-o" aria-hidden="true"></i> Categories Management
            <small>Add New Category</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Category Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <?php echo form_open_multipart('category/addNewCategory'); ?>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="categoryTitle">Category Title</label>
                                    <input type="text" class="form-control required" value="<?php echo set_value('categoryTitle'); ?>" id="categoryTitle" name="categoryTitle" maxlength="256" />
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control required" id="description" name="description"><?php echo set_value('description'); ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="taskTitle">Category Image</label>
                                    <input type="file" name="categoryImage" size="20" hidden />
                                </div>
                            </div>
                            <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="role">Status</label>
                                        <select class="form-control required" id="status" name="status" required>
                                            <option value="">Select Status</option>
                                            <option value="<?= ACTIVE ?>" <?php if (set_value('status') == ACTIVE) {
                                                                                echo "selected=selected";
                                                                            } ?> >Publish</option>
                                            <option value="<?= INACTIVE ?>" <?php if (set_value('status') == INACTIVE) {
                                                                                echo "selected=selected";
                                                                            } ?> >Unpublish</option>
                                        </select>
                                    </div>
                                </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cLabel">Type</label>
                                    <select class="form-control required" id="cLabel" name="cLabel" required>
                                        <option value="">Select Tpe</option>
                                        <option value="<?= ATTRACTION ?>" <?php if (set_value('cLabel') == ATTRACTION) {
                                                                                echo "selected=selected";
                                                                            } ?> >Attractions</option>
                                        <option value="<?= TRANSPORT ?>" <?php if (set_value('cLabel') == TRANSPORT) {
                                                                                echo "selected=selected";
                                                                            } ?>>Transportations</option>
                                    </select>
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