<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>    
            <?php echo $myobj->loadPo('Category'); ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
            <li><a href="<?php echo base_url();?>admin/category"><?php echo $myobj->loadPo('Category'); ?></a></li>
            <li class="active"><?php echo $myobj->loadPo('Category Update'); ?></li>
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
                    <h3 class="box-title"><?php echo $myobj->loadPo('Category Update'); ?></h3>
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
                                <input name="category_name" class="form-control" type="text" id="category_name" value="<?php echo $category_edit->category_name ;?>" />
                                <?php echo form_error('category_name','<span class="text-danger">','</span>'); ?>
                                <span id="error_categoryName" style="color: red;"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Category Name (Arabic)'); ?><span class="text-danger">*</span></label>
                                <input name="category_name_ar" class="form-control" type="text" id="category_name_ar" value="<?php echo $category_edit->category_name_ar ;?>" />
                                <?php echo form_error('category_name_ar','<span class="text-danger">','</span>'); ?>
                                <span id="error_categoryName" style="color: red;"></span>
                            </div>
                        </div>                      
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Category Status'); ?></label>
                                <select name="category_status" id="category_status" class="form-control">                                   
                                    <option value="1" <?php echo ($category_edit->category_status == '1') ? 'selected' : ''; ?> >Active</option>
                                    <option value="0" <?php echo ($category_edit->category_status == '0') ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <input type="hidden" name="category_filed" id="category_filed" value="0">
                        <?php
                            if(empty($category_edit->parent_category_id))
                            {
                                ?>
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Parent Category'); ?></label>
                                        <select name="category_id_arr[]" id="category_id_arr[]" class="form-control" onchange="getSubCetegory(this.value, '0');">  
                                            <option value="">-- Select --</option>
                                            <?php
                                                $category_res = $this->common_model->getData('tbl_category', array('category_status'=>'1', 'parent_category_id'=>'0'), 'multi');
                                                if(!empty($category_res))
                                                {
                                                    foreach($category_res as $c_val) 
                                                    {
                                                        ?>
                                                        <option value="<?php echo $c_val->category_id; ?>"><?php echo $c_val->category_name; ?></option>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </select>    
                                    </div>
                                </div>
                                <?php
                            }
                            else
                            {
                                $category_level_arr = explode(',', $category_edit->category_level);
                                if(!empty($category_level_arr))
                                {
                                    $i=1;
                                    foreach($category_level_arr as $c_id) 
                                    {
                                        $category_res = $this->common_model->getData('tbl_category', array('category_status'=>'1', 'category_id'=>$c_id), 'single');
                                        if(!empty($category_res))
                                        {
                                            ?>
                                            <div class="item form-group col-md-4">
                                                <div class="input text">
                                                    <?php 
                                                        if($i==1)
                                                        {
                                                            ?>
                                                            <label><?php echo $myobj->loadPo('Parent Category/Segment'); ?></label>
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <label><?php echo $myobj->loadPo('Sub Category/Segment'); ?></label>
                                                            <?php
                                                        }
                                                    ?>
                                                    <input disabled class="form-control" type="text" value="<?php echo $category_res->category_name; ?>" />
                                                </div>
                                            </div> 
                                            <?php
                                            $i++;
                                        }
                                    }
                                }
                            }
                        ?>                                      
                        <div class="item form-group col-md-4">
                            <div class="input text">
                                <label>&nbsp;</label><br>
                                <span class="btn btn-sm btn-primary" onclick="showParentCategory('Show');"><?php echo $myobj->loadPo('Change Category'); ?></span>
                                <span class="btn btn-sm btn-danger" style="display: none;" id="cancel_btn" onclick="showParentCategory('Hide');">cancel</span>
                            </div>
                        </div> 
                    </div>
                    <div class="row" id="category_parent_div" style="display: none;">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Parent Category'); ?></label>
                                <select name="category_id_arr[]" id="category_id_arr[]" class="form-control" onchange="getSubCetegory(this.value, '0');">    
                                    <option value="">-- Select --</option>
                                    <?php
                                        $category_res = $this->common_model->getData('tbl_category', array('category_status'=>'1', 'parent_category_id'=>'0'), 'multi');
                                        if(!empty($category_res))
                                        {
                                            foreach($category_res as $c_val) 
                                            {
                                                ?>
                                                <option value="<?php echo $c_val->category_id; ?>"><?php echo $c_val->category_name; ?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                </select>    
                            </div>
                        </div>
                        <div id="div_category_0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Category Image'); ?></label><br>
                                <img src='<?php echo base_url().$category_edit->category_img; ?>' width="100" /><br><br>
                                <input type="file" name="category_img" id="category_img">
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
<script type="text/javascript">
     function getSubCetegory(category_id, category_no)
    {
        if(category_id != '')
        {
            var str = 'category_id='+category_id+'&category_no='+category_no;
            var PAGE = '<?php echo base_url(); ?>commonController/getSubCetegory';
            jQuery.ajax({
                type :"POST",
                url  :PAGE,
                data : str,
                success:function(data)
                {        
                    $('#div_category_0').html(data);
                    var category_no = parseInt(category_no) + 1;
                    $('#category_filed').val(category_no);
                } 
            });
        }
        else
        {
            $('#div_category_0').html('');
            $('#category_filed').val('0');
        }
    }

    function getSubSubCategory(category_id, category_no)
    {
        var category_filed = $('#category_filed').val();
        if(category_id != '')
        {
            var str = 'category_id='+category_id+'&category_no='+category_no;
            var PAGE = '<?php echo base_url(); ?>commonController/getSubCetegory';
            jQuery.ajax({
                type :"POST",
                url  :PAGE,
                data : str,
                success:function(data)
                {        
                    $('#sub_cat_div_'+category_no).html(data);
                    $('#category_filed').val(category_no);
                } 
            });
        }
        else
        {
            for(i=category_no; i<=category_filed; i++)
            {
                 $('#sub_cat_div_'+i).html('');
            }
            $('#category_filed').val(category_no);
        }
    }


    
    function showParentCategory(action)
    {
        if(action == 'Show')
        {
            $('#category_parent_div').show();
            $('#cancel_btn').show();
        }   
        else
        {
            $('#category_parent_div').hide();
            $('#cancel_btn').hide();
        }   
    }

</script>
