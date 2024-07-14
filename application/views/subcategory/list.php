<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-user-circle-o" aria-hidden="true"></i> <?= $clabel ?> Management
            <small>Add, Edit, Delete</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                <?php if ( !empty($records) && check_permission($records[0]->categoryName, 'create_records')) { ?>
                    <a class="btn btn-primary" href="<?php echo base_url('packages/add' . $parms) ?>"><i class="fa fa-plus"></i> Add New </a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
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
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">All <?= $clabel ?> List of <strong>(<?= (isset($records[0]->categoryName)) ? ucfirst($records[0]->categoryName) : ''; ?>)</strong></h3>
                        <div class="box-tools">
                            <form action="<?php echo base_url('packages/listing' . $parms) ?>" method="POST" id="searchList">
                                <div class="input-group">
                                    <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" />
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
                            if (!empty($records)) {
                                $count = 1;
                                $cr = array(' ', '!', '@', '#', '$', '%', '^', '^', '&', '*', ':', ';', '"', "'", ',', '.', '?', '/');
                                foreach ($records as $record) {
                                    $uc = ucfirst($record->categoryName);
                                    $trm = str_replace($cr, '', $uc);
                                    $mainCategory = $trm;
                            ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><img src="<?= base_url() . $record->subcatImage ?>" alt="<?php echo $record->subcatName ?>" width="35" height="35"></td>
                                        <td><?php echo $record->subcatName ?></td>
                                        <td><?php echo $record->subcatDescription ?></td>
                                        <td>
                                            <?php
                                            if ($record->isPublished == ACTIVE) {
                                            ?> <span class="label label-success">Published</span> <?php
                                                } else {
                                                    ?> <span class="label label-warning">Unpublished</span> <?php
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo date("d-m-Y", strtotime($record->createdDtm)) ?></td>
                                        <td class="text-center">
                                        <?php if (check_permission($record->categoryName, 'create_records')) { ?>
                                            <a class="btn btn-sm btn-success" href="<?php echo base_url() . 'services/listing?txt=' . $mainCategory . '&id=' . $record->maincatId; ?>" title="Service"><i class="fa fa-plus"></i></a>
                                            <?php } if (check_permission($record->categoryName, 'edit_records')) { ?>
                                            <a class="btn btn-sm btn-info" href="<?php echo base_url('packages/edit' . $parms.'&scid='.$record->subcatId); ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                                            <?php } if (check_permission($record->categoryName, 'delete_records')) { ?>
                                            <a class="btn btn-sm btn-danger deletecommon" href="#" data-taskname="subcategories" data-col="subcatId" data-taskid="<?php echo $record->subcatId; ?>" title="Delete"><i class="fa fa-trash"></i></a>
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
    jQuery(document).ready(function() {
        jQuery('ul.pagination li a').click(function(e) {
            e.preventDefault();
            var link = jQuery(this).get(0).href;
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "packages/listing/" + value+ '/<?=$parms?>');
            jQuery("#searchList").submit();
        });
    });
</script>