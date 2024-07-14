
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-user-circle-o" aria-hidden="true"></i> Website Settings
            <small>Add / Edit Role</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
 
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Website Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" action="" method="post" role="form" enctype="multipart/form-data" >
                        <div class="box-body">
                            <div class="row">
                               
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="web_name">Webiste Name</label>
                                        <input type="text" id="web_name" name="web_name" value="<?= $records->web_name ?? '' ?>" class="form-control required" placeholder="Enter Website name" <?= ($access == 'false')? 'disabled readonly' : ''  ?>   />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fb_link">Facebook Link</label>
                                        <input type="url" id="fb_link" name="fb_link" value="<?= $records->fb_link ?? 'https://www.facebook.com' ?>" class="form-control required" placeholder="Enter Website name" <?= ($access == 'false')? 'disabled readonly' : ''  ?>   />
                                    </div>
                                </div>
                               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inst_link">Instgram Link</label>
                                        <input type="url" id="inst_link" name="inst_link" value="<?= $records->inst_link ?? 'https://www.instgram.com'  ?>" class="form-control required" placeholder="Enter facebook link" <?= ($access == 'false')? 'disabled readonly' : ''  ?>  />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="youtube_link">Youtube Link</label>
                                        <input type="url" id="youtube_link" name="youtube_link" value="<?= $records->youtube_link ?? 'https://www.youtube.com' ?>" placeholder="Enter Youtube link" class="form-control required"  <?= ($access == 'false')? 'disabled readonly' : ''  ?>  />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="x_link">Twitter(X) Link</label>
                                        <input type="url" id="x_link" name="x_link" value="<?= $records->x_link ?? 'https://www.x.com' ?>" placeholder="Enter Twitter (X) link" class="form-control required" <?= ($access == 'false')? 'disabled readonly' : ''  ?> />
                                    </div>
                                </div>
                               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="linkedin_link">Linkedin Link</label>
                                        <input type="url" id="linkedin_link" name="linkedin_link" value="<?= $records->linkedin_link ?? 'https://www.linkedin.com' ?>" placeholder="Enter Linkedin link" class="form-control required" <?= ($access == 'false')? 'disabled readonly' : ''  ?> />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact">Contact number</label>
                                        <input type="text" id="contact" name="contact" value="<?= $records->contact ?? '' ?>" placeholder="Enter Contact number" class="form-control required" <?= ($access == 'false')? 'disabled readonly' : ''  ?> />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="whatstapp">Whatstapp number</label>
                                        <input type="text" id="whatstapp" name="whatstapp" value="<?= $records->whatstapp ?? '' ?>" placeholder="Enter Whatstapp number" class="form-control required" <?= ($access == 'false')? 'disabled readonly' : ''  ?> />
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="terms_condition">Terms & Condition</label>
                                        <input type="url" id="terms_condition" name="terms_condition" value="<?= $records->terms_condition ?? '' ?>" placeholder="Enter terms & condition link" class="form-control required" <?= ($access == 'false')? 'disabled readonly' : ''  ?>  />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="privacy">privacy Policy</label>
                                        <input type="url" id="privacy" name="privacy" value="<?= $records->privacy ?? '' ?>" placeholder="Enter privacy policy link" class="form-control required" <?= ($access == 'false')? 'disabled readonly' : ''  ?> />
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="web_address">Address </label>
                                        <input type="text" id="web_address" name="web_address" value="<?= $records->web_address ?? '' ?>" placeholder="Enter address" class="form-control required" <?= ($access == 'false')? 'disabled readonly' : ''  ?>  />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email_address">Email Address </label>
                                        <input type="email" id="email_address" name="email_address" value="<?= $records->email_address ?? '' ?>" placeholder="Enter Email address" class="form-control required" <?= ($access == 'false')? 'disabled readonly' : ''  ?> />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="opening_time">Opening Time </label>
                                        <input type="text" id="opening_time" name="opening_time" value="<?= $records->opening_time ?? '24/7 hours' ?>" placeholder="Enter Opening Time" class="form-control required" <?= ($access == 'false')? 'disabled readonly' : ''  ?>  />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control required" id="status" name="status" <?= ($access == 'false')? 'disabled readonly' : ''  ?>>
                                            <option value="">Select Status</option>
                                            <option value="<?= ACTIVE ?>"  <?= (($records->status ?? '1' ) == ACTIVE)? 'selected': '' ?> >Active</option>
                                            <option value="<?= INACTIVE ?>" <?= (($records->status ?? '1' ) == INACTIVE)? 'selected': '' ?>>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="web_logo">Webiste logo </label>
                                    <input type="file"  id="web_logo" name="web_logo" placeholder="Select website logo" class="form-control required" <?= ($access == 'false')? 'disabled readonly' : ''  ?>  />
                                    <br>
                                        <img src="<?= base_url(). ($records->web_logo ?? '') ?>" alt="<?= $records->web_logo ?? '' ?>" width="100px" height="100px"  >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="web_desc">Description </label>
                                    <textarea  id="web_desc" name="web_desc" placeholder="Write a description here... " class="form-control required" rows="3" cols="3" <?= ($access == 'false')? 'disabled readonly' : ''  ?> ><?= $records->web_desc ?? '' ?></textarea>
                                    
                                </div>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            
                            <input type="submit"  class="btn btn-primary" value="Submit" <?= ($access == 'false')? 'disabled readonly' : ''  ?> />
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </section>
</div>