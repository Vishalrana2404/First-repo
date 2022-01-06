<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php echo $myobj->loadPo('Book'); ?> </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
            <li><a href="<?php echo base_url();?>admin/book"><?php echo $myobj->loadPo('Book'); ?></a></li>
            <li class="active"><?php echo $myobj->loadPo('Update Book'); ?></li>
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
                    <h3 class="box-title"><?php echo $myobj->loadPo('Update Book'); ?></h3>
                </div>
                <div class="pull-right box-tools">
                    <a href="<?php echo base_url();?>admin/book" class="btn btn-info btn-sm"><?php echo $myobj->loadPo('Back'); ?></a>                           
                </div>
            </div>
            <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <?php  $csrf = array( 'name' => $this->security->get_csrf_token_name(), 'hash' => $this->security->get_csrf_hash() ); ?>
                <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Book Name (English)'); ?><span class="text-danger">*</span></label>
                                <input name="book_name" class="form-control" type="text" id="book_name" value="<?php echo $book_edit->book_name; ?>" />
                                <?php echo form_error('book_name','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Book Name (Arabic)'); ?><span class="text-danger">*</span></label>
                                <input name="book_name_ar" class="form-control" type="text" id="book_name_ar" value="<?php echo $book_edit->book_name_ar; ?>" />
                                <?php echo form_error('book_name_ar','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Book Status'); ?></label>
                                <select name="book_status" id="book_status" class="form-control">
                                    <option <?php echo ($book_edit->book_status == '1') ? 'selected' : ''; ?> value="1">Active</option>
                                    <option <?php echo ($book_edit->book_status == '0') ? 'selected' : ''; ?> value="0">Inactive</option>
                                </select>
                            </div>
                        </div>                      
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Publish Date'); ?><span class="text-danger">*</span></label>
                                <div class='input-group'>
                                    <input type="text" name="book_publish_date" id="book_publish_date" class="form-control date_val" value="<?php echo $book_edit->book_publish_date; ?>">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <?php echo form_error('book_publish_date','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Publisher'); ?></label>
                                <select name="publishers_id" id="publishers_id" class="form-control">
                                    <option value=""></option>
                                    <?php
                                        $publishers_res = $this->common_model->getData('tbl_publishers', array('publishers_status'=>'1'), 'multi');
                                        if(!empty($publishers_res)){
                                            foreach($publishers_res as $ar_val){
                                                ?>
                                                <option <?php echo ($book_edit->publishers_id == $ar_val->publishers_id) ? 'selected' : ''; ?>  value="<?php echo $ar_val->publishers_id; ?>"><?php echo $ar_val->publishers_name; ?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Language'); ?><span class="text-danger">*</span></label>
                                <input name="book_language" class="form-control" type="text" id="book_language" value="<?php echo $book_edit->book_language; ?>" />
                                <?php echo form_error('book_language','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Edition'); ?><span class="text-danger">*</span></label>
                                <input name="book_edition" class="form-control" type="text" id="book_edition" value="<?php echo $book_edit->book_edition; ?>" />
                                <?php echo form_error('book_edition','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('ISBN'); ?><span class="text-danger">*</span></label>
                                <input name="book_isbn_no" class="form-control" type="text" id="book_isbn_no" value="<?php echo $book_edit->book_isbn_no; ?>" />
                                <?php echo form_error('book_isbn_no','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Number of Pages'); ?><span class="text-danger">*</span></label>
                                <input name="book_no_of_pages" class="form-control" type="text" id="book_no_of_pages" value="<?php echo $book_edit->book_no_of_pages; ?>" />
                                <?php echo form_error('book_no_of_pages','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Author'); ?></label>
                                <select name="authors_id" id="authors_id" class="form-control">
                                    <?php
                                        $authors_res = $this->common_model->getData('tbl_authors', array('authors_status'=>'1'), 'multi');
                                        if(!empty($authors_res)){
                                            foreach($authors_res as $ar_val){
                                                ?>
                                                <option <?php echo ($book_edit->authors_id == $ar_val->authors_id) ? 'selected' : ''; ?>  value="<?php echo $ar_val->authors_id; ?>"><?php echo $ar_val->authors_name; ?></option>
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
                                    <option <?php echo ($book_edit->discount_status == '1') ? 'No' : ''; ?> value="No">No</option>
                                    <option <?php echo ($book_edit->discount_status == '1') ? 'Yes' : ''; ?> value="Yes">Yes</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group col-md-4" style="display: none;" id="discount_id_div">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Discount'); ?></label>
                                <select name="discount_id" id="discount_id" class="form-control">
                                    <?php
                                        $discount_res = $this->common_model->getData('tbl_discount', array('discount_status'=>'1', 'discount_end_date >'=>date('Y-m-d')), 'multi');
                                        if(!empty($discount_res)){
                                            foreach($discount_res as $ar_val){
                                                ?>
                                                <option <?php echo ($book_edit->discount_id == $ar_val->discount_id) ? 'selected' : ''; ?> value="<?php echo $ar_val->discount_id; ?>"><?php echo $ar_val->discount_name; ?></option>
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
                                <input name="book_price" class="form-control" type="number" min="0" id="book_price" value="<?php echo $book_edit->book_price; ?>" />
                                <?php echo form_error('book_price','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Book Thumbnail Image'); ?></label><br>
                                <img src="<?php echo base_url().$book_edit->book_img; ?>" width="100" height="100"><br><br>
                                <input type="file" name="book_img" id="book_img">
                                <span style="color: red;" id="image_error"></span>
                            </div>
                        </div>
                    </div>               
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Book More Image'); ?><span style="font-size: 10px;"> (Select multiple images)</span></label>
                                <input type="file" name="book_more_img[]" id="book_more_img" multiple>
                                <span style="color: red;" id="image_error"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <?php
                                $book_more_images = $this->common_model->getData('tbl_book_img', array('book_id'=>$book_edit->book_id), 'multi');
                                if(!empty($book_more_images)){
                                    foreach($book_more_images as $g_img) {
                                        ?>
                                        <div style='float:left;border:4px solid #303641;padding:5px;margin:5px;' id="book_img_<?php echo $g_img->book_img_id; ?>"><img height='80' src='<?php echo base_url().$g_img->book_img; ?>'>&nbsp;<button class="btn btn-danger btn-xs" type="button" onclick="removeBookMoreImage('<?= $g_img->book_img_id; ?>')" style="margin-top: -60px;"><i class="fa fa-trash"></i></button></div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <input type="hidden" name="category_filed" id="category_filed" value="0">
                        <?php
                            if(!empty($book_edit->category_id))
                            {
                                ?>
                                <div class="form-group col-md-4">
                                    <div class="input text">
                                        <label><?php echo $myobj->loadPo('Parent Category'); ?></label>
                                        <?php
                                            $category_detail = $this->common_model->getData('tbl_category', array('parent_category_id'=>$book_edit->category_id), 'single');
                                            if(!empty($category_detail))
                                            {
                                                ?>
                                                <input disabled class="form-control" type="text" value="<?php echo $category_detail->category_name; ?>" />
                                                <?php
                                            }
                                        ?>  
                                    </div>
                                </div>
                                <?php
                            }
                        ?>                                      
                        <div class="item form-group col-md-4">
                            <div class="input text">
                                <label>&nbsp;</label><br>
                                <span class="btn btn-sm btn-primary" onclick="showParentCategory('Show');"><?php echo $myobj->loadPo('Change Category'); ?></span>
                                <span class="btn btn-sm btn-danger" style="display: none;" id="cancel_btn" onclick="showParentCategory('Hide');"><?php echo $myobj->loadPo('About'); ?>cancel</span>
                            </div>
                        </div> 
                    </div>
                    <div class="row" id="category_parent_div" style="display: none;">
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
                        <div class="form-group col-md-6">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Book Sort Description (English)'); ?><span class="text-danger">*</span></label>
                                <textarea name="book_sort_description" class="form-control" id="book_sort_description"><?php echo $book_edit->book_sort_description; ?></textarea>
                                <?php echo form_error('book_sort_description','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Book Sort Description (Arabic)'); ?><span class="text-danger">*</span></label>
                                <textarea name="book_sort_description_ar" class="form-control" id="book_sort_description_ar"><?php echo $book_edit->book_sort_description_ar; ?></textarea>
                                <?php echo form_error('book_sort_description_ar','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Book Description (English)'); ?><span class="text-danger">*</span></label>
                                <textarea name="book_description" class="form-control tiny_textarea" id="book_description"><?php echo $book_edit->book_description; ?></textarea>
                                <?php echo form_error('book_description','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Book Description (Arabic)'); ?><span class="text-danger">*</span></label>
                                <textarea name="book_description_ar" class="form-control tiny_textarea" id="book_description_ar"><?php echo $book_edit->book_description_ar; ?></textarea>
                                <?php echo form_error('book_description_ar','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                    </div>
                     <div class="row">
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Variants'); ?></label>
                            </div>
                        </div>
                    </div>
                    <?php
                        if($user_type == 'vendor'){
                            $variant_res= $this->common_model->getData('tbl_variant', array('variant_status'=>'1', 'user_id'=>$this->data['session']->user_id), 'multi');
                        }
                        else{
                            $variant_res= $this->common_model->getData('tbl_variant', array('variant_status'=>'1'), 'multi');
                        }
                        if(!empty($variant_res)){
                            foreach ($variant_res as $v_val) {
                                ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="label-primary" style="margin-bottom: 18px; color: #fff; padding: 6px;"><?php echo $v_val->variant_name; ?>:</h4>
                                    </div>
                                </div>
                                <?php
                                    $product_variant_res = $this->common_model->getData('tbl_product_variant', array('book_id'=>$book_edit->book_id, 'variant_id'=>$v_val->variant_id, 'product_variant_status'=>'1'), 'multi');
                                    if(!empty($product_variant_res)){
                                        foreach($product_variant_res as $pv_val) {
                                            ?>
                                            <div class="row" id="variant_div_<?php echo $pv_val->product_variant_id; ?>">
                                                <div class="form-group col-md-4">
                                                    <div class="input text">
                                                        <label><?php echo $myobj->loadPo('Value'); ?></label>
                                                        <input disabled class="form-control" type="text" value="<?php echo $pv_val->variant_value; ?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <div class="input text">
                                                        <label><?php echo $myobj->loadPo('Price'); ?></label>
                                                        <input disabled class="form-control" type="text" value="<?php echo $pv_val->variant_price; ?>" />
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <div class="input text">
                                                        <label></label><br>
                                                        <button onclick="removeProductVariantValue(<?php echo $pv_val->product_variant_id; ?>);" class="btn btn-danger btn-sm" type="button"><i class="fa fa-trash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                ?>
                                <input type="hidden" name="variant_no_<?php echo $v_val->variant_id; ?>" id="variant_no_<?php echo $v_val->variant_id; ?>" value="1">
                                <div id="sub_variant_<?php echo $v_val->variant_id; ?>">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <div class="input text">
                                                <label><?php echo $myobj->loadPo('Value 1'); ?></label>
                                                <input name="variant_value_<?php echo $v_val->variant_id; ?>[]" class="form-control" type="text" value="" />
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="input text">
                                                <label><?php echo $myobj->loadPo('Price 1'); ?></label>
                                                <input name="variant_price_<?php echo $v_val->variant_id; ?>[]" class="form-control" type="text" value="" />
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <div class="input text">
                                                <label></label><br>
                                                <button type="button" class="btn btn-info btn-sm" onclick="addNewValue(<?php echo $v_val->variant_id; ?>);"><i class="fa fa-plus"></i></button>
                                                <button onclick="removeValue(<?php echo $v_val->variant_id; ?>);" class="btn btn-danger btn-sm" type="button" style="margin-left: 20px; display: none;" id="remove_variant_<?php echo $v_val->variant_id; ?>"><i class="fa fa-remove"></i></button><br><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } 
                    ?>
                </div>
                <!-- /.box-body -->      
                <div class="box-footer">
                    <button class="btn btn-success btn-sm" type="submit" name="Submit" value="Edit" ><?php echo $myobj->loadPo('Edit'); ?></button>
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
    function showDiscount(discount_status){
        if(discount_status == 'Yes'){
            $('#discount_id_div').show();
        }
        else{
            $('#discount_id_div').hide();
        }
    }
    function removeBookMoreImage(book_img_id)
    {
        if (confirm("Are you sure you want to Delete!")) {
            var PAGE = '<?php echo base_url().MODULE_NAME?>book/removeBookMoreImage/';       
            var str = 'book_img_id='+book_img_id+'&<?php echo $this->security->get_csrf_token_name(); ?>='+'<?php echo $this->security->get_csrf_hash(); ?>';
            $.ajax({
                url: PAGE,
                type: 'POST',
                data: str,
                success: function(response){                
                    if(response){
                        $('#book_img_'+book_img_id).remove();
                    }
                    else{
                        $('#error_image_'+book_img_id).html('Image removing faild please try again!')
                    }
                }
            });            
        }
    }
    function addNewValue(variant_id){
        var variant_no = $('#variant_no_'+variant_id).val();
        var variant_new = parseInt(variant_no) + 1;
        $('#variant_no_'+variant_id).val(variant_new);
        $('#remove_variant_'+variant_id).show();
        var newTextBoxDiv = $(document.createElement('div')).attr("id", 'rm_employment_div_'+variant_id+'_'+variant_new);
        newTextBoxDiv.after().html(`
            <div class="row">
                <div class="item form-group col-md-4">
                    <div class="input text">
                        <label><?php echo $myobj->loadPo('Value'); ?> `+variant_new+`</label>
                        <input required name="variant_value_`+variant_id+`[]" class="form-control" type="text" value="" />
                    </div>
                </div>
                <div class="item form-group col-md-4">
                    <div class="input text">
                        <label><?php echo $myobj->loadPo('Price'); ?> `+variant_new+`</label>
                        <input required name="variant_price_`+variant_id+`[]" class="form-control" type="text" value="" />
                    </div>
                </div>
            </div> 
            `);
        newTextBoxDiv.appendTo("#sub_variant_"+variant_id);
    }

    function removeValue(variant_id){
        var variant_no = $('#variant_no_'+variant_id).val();
        var variant_new = parseInt(variant_no) - 1;
        $('#variant_no_'+variant_id).val(variant_new);
        $("#rm_employment_div_"+variant_id+'_'+variant_no).remove();
        if (variant_new == 1) {
            $('#remove_variant_'+variant_id).hide();
        }
    }
</script>