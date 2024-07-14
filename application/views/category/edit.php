<?php
if(!empty($categoryInfo)){
    $cId = $categoryInfo->categoryId;
$cImage = $categoryInfo->categoryImage;
$cName = $categoryInfo->categoryName;
$cDescription = $categoryInfo->description;
$status = $categoryInfo->isPublished; 
$cLabel = $categoryInfo->categoryLabel; 
}else{
    redirect('category');
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user-circle-o" aria-hidden="true"></i> Category Management
        <small>Edit Category</small>
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
                    <?php echo form_open_multipart('category/editCategory'); ?>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="categoryTitle">Category Title</label>
                                        <input type="text" class="form-control required" value="<?= $cName; ?>" id="categoryTitle" name="categoryName" maxlength="250" />
                                        <input type="hidden" hidden="hidden" class="form-control required" value="<?= $cId; ?>" id="categoryId" name="categoryId" maxlength="4" />
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control required" id="description" name="description"><?= $cDescription; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="taskTitle">New Image</label>
                                        <input type="file" name="categoryImage" size="20" value="" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                   <div class="form-group">
                                        <label for="role">Status</label>
                                        <select class="form-control required" id="status" name="status" required>
                                            <option value="">Select Status</option>
                                            <option value="<?= ACTIVE ?>" <?php if($status == ACTIVE) {echo "selected=selected";} ?>>Publish</option>
                                            <option value="<?= INACTIVE ?>" <?php if($status == INACTIVE) {echo "selected=selected";} ?>>Unpublish</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cLabel">Type</label>
                                    <select class="form-control required" id="cLabel" name="cLabel" required>
                                        <option value="">Select Tpe</option>
                                        <option value="<?= ATTRACTION ?>" <?php if ($cLabel == ATTRACTION) {
                                                                                echo "selected=selected";
                                                                            } ?>>Attractions</option>
                                        <option value="<?= TRANSPORT ?>" <?php if ($cLabel == TRANSPORT) {
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
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
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