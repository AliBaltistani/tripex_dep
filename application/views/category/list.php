<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user-circle-o" aria-hidden="true"></i> Category Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                <?php if((check_permission('Categories','create_records') == 1)){ ?>
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>category/add"><i class="fa fa-plus"></i> Add New Category</a>
                <?php } ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
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
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Category List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>category/categoryListing" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                        <th>Sr.#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>status</th>
                        <th>Created On</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($records))
                    {
                        $count = 1;
                        foreach($records as $record)
                        {
                    ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><img src="<?= base_url().$record->categoryImage ?>" alt="<?php echo $record->categoryName ?>" width="35" height="35"></td>
                        <td><?php echo $record->categoryName ?></td>
                        <td><?php echo $record->description ?></td>
                        <td>
                            <?php 
                            if($record->isPublished == ACTIVE) {
                                ?> <span class="label label-success">Published</span> <?php
                            } else {
                                ?> <span class="label label-warning">Unpublished</span> <?php
                            }
                            ?>
                        </td>
                        <td><?php echo date("d-m-Y", strtotime($record->createdDtm)) ?></td>
                        <td class="text-center">
                        <?php if ((check_permission('Categories','edit_records') == 1)) { ?>
                            <a class="btn btn-sm btn-info" href="<?php echo base_url().'category/edit/'.$record->categoryId; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                            <?php } if ((check_permission('Categories','delete_records') == 1)) { ?>
                            <a class="btn btn-sm btn-danger deletecommon" href="#" data-taskname="categories" data-col="categoryId" data-taskid="<?php echo $record->categoryId; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
    
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "category/categoryListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
