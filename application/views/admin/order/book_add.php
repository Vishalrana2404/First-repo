<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>	
			<?php echo $myobj->loadPo('Book'); ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
            <li><a href="<?php echo base_url();?>admin/book"><?php echo $myobj->loadPo('Book'); ?></a></li>
            <li class="active"><?php echo $myobj->loadPo('Create Book'); ?></li>
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
                    <h3 class="box-title"><?php echo $myobj->loadPo('Create Book'); ?></h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/book" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Back'); ?></a>                           
                </div>
            </div>
            <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Book Name (English)'); ?><span class="text-danger">*</span></label>
                                <input name="book_name" class="form-control" type="text" id="book_name" value="<?php echo set_value('book_name'); ?>" />
                                <?php echo form_error('book_name','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Book Name (Arabic)'); ?><span class="text-danger">*</span></label>
                                <input name="book_name_ar" class="form-control" type="text" id="book_name_ar" value="<?php echo set_value('book_name_ar'); ?>" />
                                <?php echo form_error('book_name_ar','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Book Status'); ?></label>
                                <select name="book_status" id="book_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>                      
                    </div>
                    <div class="row"> 
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Author'); ?></label>
                                <select name="authors_id" id="authors_id" class="form-control">
                                    <option value=""></option>
                                    <?php
                                        $authors_res = $this->common_model->getData('tbl_authors', array('authors_status'=>'1'), 'multi');
                                        if(!empty($authors_res)){
                                            foreach($authors_res as $ar_val){
                                                ?>
                                                <option value="<?php echo $ar_val->authors_id; ?>"><?php echo $ar_val->authors_name; ?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Discount Status'); ?></label>
                                <select name="discount_status" id="discount_status" class="form-control" onchange="showDiscount(this.value)">
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group col-md-4" style="display: none;" id="discount_id_div">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Discount'); ?></label>
                                <select name="discount_id" id="discount_id" class="form-control">
                                    <option value="">-- Select --</option>
                                    <?php
                                        $discount_res = $this->common_model->getData('tbl_discount', array('discount_status'=>'1', 'discount_end_date >'=>date('Y-m-d')), 'multi');
                                        if(!empty($discount_res)){
                                            foreach($discount_res as $ar_val){
                                                ?>
                                                <option value="<?php echo $ar_val->discount_id; ?>"><?php echo $ar_val->discount_name; ?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>                  
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Book Price'); ?><span class="text-danger">*</span></label>
                                <input name="book_price" class="form-control" type="number" min="0" id="book_price" value="<?php echo set_value('book_price'); ?>" />
                                <?php echo form_error('book_price','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Book Thumbnail Image'); ?></label>
                                <input type="file" name="book_img" id="book_img">
                                <span style="color: red;" id="image_error"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Book More Image'); ?><span style="font-size: 10px;"> (Select multiple images)</span></label>
                                <input type="file" name="book_more_img[]" id="book_more_img" multiple>
                                <span style="color: red;" id="image_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <input type="hidden" name="category_filed" id="category_filed" value="0">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Parent Category'); ?></label>
                                <select name="category_id_arr[]" id="category_id_arr[]" class="form-control" onchange="getSubCetegorySpec(this.value, '0');">    
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
                        <div class="form-group col-md-12">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Book Description (English)'); ?><span class="text-danger">*</span></label>
                                <textarea name="book_description" class="form-control tiny_textarea" id="book_description"></textarea>
                                <?php echo form_error('book_description','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Book Description (Arabic)'); ?><span class="text-danger">*</span></label>
                                <textarea name="book_description_ar" class="form-control tiny_textarea" id="book_description_ar"></textarea>
                                <?php echo form_error('book_description_ar','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->      
                <div class="box-footer">
                    <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Add" ><?php echo $myobj->loadPo('Submit'); ?></button>
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/book"><?php echo $myobj->loadPo('Cancel'); ?></a>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<!-- /.right-side -->
<script type="text/javascript">
    function getSubCetegorySpec(category_id, category_no)
    {
        if(category_id != '')
        {
            var str = 'category_id='+category_id+'&category_no='+category_no;
            var PAGE = '<?php echo base_url(); ?>commonController/getSubCetegorySpec';
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

    function getSubSubCategorySpec(category_id, category_no)
    {
        var category_filed = $('#category_filed').val();
        if(category_id != '')
        {
            var str = 'category_id='+category_id+'&category_no='+category_no;
            var PAGE = '<?php echo base_url(); ?>commonController/getSubSubCategorySpec';
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

    function showDiscount(discount_status){
        if(discount_status == 'Yes'){
            $('#discount_id_div').show();
        }
        else{
            $('#discount_id_div').hide();
        }
    }
</script>