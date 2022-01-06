<?php echo $myobj->loadPo('About'); ?><aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>    
            <?php echo $myobj->loadPo('Category'); ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
            <li><a href="<?php echo base_url();?>admin/category"><?php echo $myobj->loadPo('Category'); ?></a></li>
            <li class="active"><?php echo $myobj->loadPo('Category View'); ?></li>
        </ol>
    </section>
    <div>
        <div id="msg_div">
            <?php echo $this->session->flashdata('message');?>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">       
        <div class="box">
            <div class="box-header">
                <div class="pull-left">
                    <h3 class="box-title"><?php echo $myobj->loadPo('Category View'); ?></h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/category" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Back'); ?></a>                           
                </div>
            </div>
            <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Category Name (English)'); ?><span class="text-danger">*</span></label>
                                <input disabled name="category_name" class="form-control" type="text" id="category_name" value="<?php echo $category_edit->category_name ;?>" />
                                <?php echo form_error('category_name','<span class="text-danger">','</span>'); ?>
                                <span id="error_categoryName" style="color: red;"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Category Name (Arabic)'); ?><span class="text-danger">*</span></label>
                                <input disabled name="category_name_ar" class="form-control" type="text" id="category_name_ar" value="<?php echo $category_edit->category_name_ar ;?>" />
                                <?php echo form_error('category_name_ar','<span class="text-danger">','</span>'); ?>
                                <span id="error_categoryName" style="color: red;"></span>
                            </div>
                        </div>                      
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Category Status'); ?></label>
                                <select disabled name="category_status" id="category_status" class="form-control">
                                    <option value="1" <?php echo ($category_edit->category_status == '1') ? 'selected' : ''; ?> >Active</option>
                                    <option value="0" <?php echo ($category_edit->category_status == '0') ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                            if(!empty($category_edit->parent_category_id))
                            {
                                $category_level_arr = explode(',', $category_edit->category_level);
                                $i=1;
                                foreach($category_level_arr as $cal_level) 
                                {
                                    $sub_cate_res = $this->common_model->getData('tbl_category', array('category_id'=>$cal_level), 'multi');
                                    if(!empty($sub_cate_res))
                                    {
                                        ?>
                                        <div id="div_category">
                                            <div class="form-group col-md-4">
                                                <div class="input text">
                                                    <?php 
                                                        if($i==1){
                                                            ?>
                                                            <label>Parent Category</label>
                                                            <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <label>Sub Category</label>
                                                            <?php
                                                        }
                                                    ?>
                                                    <select disabled class="form-control"  name="category_id_arr[]" id="category_id_arr" onchange="getSubSubCategory(this.value, <?php echo $cal_level; ?>);">
                                                        <?php
                                                            foreach($sub_cate_res as $s_val) 
                                                            {
                                                                ?>
                                                                <option <?php if($cal_level == $s_val->category_id){ echo "selected"; } ?> value="<?php echo $s_val->category_id; ?>"><?php echo $s_val->category_name; ?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="sub_cat_div_<?php echo $cal_level; ?>"></div>
                                        </div>
                                        <?php
                                    }
                                    $i++;
                                }
                            }
                        ?>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Category Image'); ?></label><br>
                                <img src='<?php echo base_url().$category_edit->category_img; ?>' width="100" />  <br>
                            </div>
                        </div>                      
                    </div>
                </div>
                <!-- /.box-body -->      
                <div class="box-footer">
                    <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Edit" ><?php echo $myobj->loadPo('Update'); ?></button>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/category"><?php echo $myobj->loadPo('Cancel'); ?></a>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<!-- /.right-side -->