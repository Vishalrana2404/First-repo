<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo $myobj->loadPo('Book'); ?>  </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-dashboard"></i> <?php echo $myobj->loadPo('Home'); ?></a></li>
            <li><a href="<?php echo base_url();?>admin/book"><?php echo $myobj->loadPo('Book'); ?></a></li>
            <li class="active"><?php echo $myobj->loadPo('Book View'); ?></li>
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
                    <h3 class="box-title"><?php echo $myobj->loadPo('Book View'); ?></h3>
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
                                <input disabled name="book_name" class="form-control" type="text" id="book_name" value="<?php echo $book_edit->book_name; ?>" />
                                <?php echo form_error('book_name','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Book Name (Arabic)'); ?><span class="text-danger">*</span></label>
                                <input disabled name="book_name_ar" class="form-control" type="text" id="book_name_ar" value="<?php echo $book_edit->book_name_ar; ?>" />
                                <?php echo form_error('book_name_ar','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Book Status'); ?></label>
                                <select disabled name="book_status" id="book_status" class="form-control">
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
                                    <input disabled type="text" name="book_publish_date" id="book_publish_date" class="form-control date_val" value="<?php echo $book_edit->book_publish_date; ?>">
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
                                <select disabled name="publishers_id" id="publishers_id" class="form-control">
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
                                <input disabled name="book_language" class="form-control" type="text" id="book_language" value="<?php echo $book_edit->book_language; ?>" />
                                <?php echo form_error('book_language','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Edition'); ?><span class="text-danger">*</span></label>
                                <input disabled name="book_edition" class="form-control" type="text" id="book_edition" value="<?php echo $book_edit->book_edition; ?>" />
                                <?php echo form_error('book_edition','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('ISBN'); ?><span class="text-danger">*</span></label>
                                <input disabled name="book_isbn_no" class="form-control" type="text" id="book_isbn_no" value="<?php echo $book_edit->book_isbn_no; ?>" />
                                <?php echo form_error('book_isbn_no','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Number of Pages'); ?><span class="text-danger">*</span></label>
                                <input disabled name="book_no_of_pages" class="form-control" type="text" id="book_no_of_pages" value="<?php echo $book_edit->book_no_of_pages; ?>" />
                                <?php echo form_error('book_no_of_pages','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Author'); ?></label>
                                <select disabled name="authors_id" id="authors_id" class="form-control">
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
                                <select disabled name="discount_status" id="discount_status" class="form-control" onchange="showDiscount(this.value)">
                                    <option <?php echo ($book_edit->discount_status == '1') ? 'No' : ''; ?> value="No">No</option>
                                    <option <?php echo ($book_edit->discount_status == '1') ? 'Yes' : ''; ?> value="Yes">Yes</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group col-md-4" style="display: none;" id="discount_id_div">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Discount'); ?></label>
                                <select disabled name="discount_id" id="discount_id" class="form-control">
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
                                <input disabled name="book_price" class="form-control" type="number" min="0" id="book_price" value="<?php echo $book_edit->book_price; ?>" />
                                <?php echo form_error('book_price','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Book Thumbnail Image'); ?></label><br>
                                <img src="<?php echo base_url().$book_edit->book_img; ?>" width="100" height="100"><br><br>
                            </div>
                        </div>
                    </div>               
                    <div class="row">
                        <div class="form-group col-md-12">
                            <?php
                                $book_more_images = $this->common_model->getData('tbl_book_img', array('book_id'=>$book_edit->book_id), 'multi');
                                if(!empty($book_more_images)){
                                    foreach($book_more_images as $g_img) {
                                        ?>
                                        <div style='float:left;border:4px solid #303641;padding:5px;margin:5px;' id="book_img_<?php echo $g_img->book_img_id; ?>"><img height='80' src='<?php echo base_url().$g_img->book_img; ?>'></div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row">
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
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Book Sort Description (English)'); ?><span class="text-danger">*</span></label>
                                <textarea disabled name="book_sort_description" class="form-control" id="book_sort_description"><?php echo $book_edit->book_sort_description; ?></textarea>
                                <?php echo form_error('book_sort_description','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Book Sort Description (Arabic)'); ?><span class="text-danger">*</span></label>
                                <textarea disabled name="book_sort_description_ar" class="form-control" id="book_sort_description_ar"><?php echo $book_edit->book_sort_description_ar; ?></textarea>
                                <?php echo form_error('book_sort_description_ar','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Book Description (English)'); ?><span class="text-danger">*</span></label>
                                <textarea disabled name="book_description" class="form-control tiny_textarea" id="book_description"><?php echo $book_edit->book_description; ?></textarea>
                                <?php echo form_error('book_description','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="input text">
                                <label><?php echo $myobj->loadPo('Book Description (Arabic)'); ?><span class="text-danger">*</span></label>
                                <textarea disabled name="book_description_ar" class="form-control tiny_textarea" id="book_description_ar"><?php echo $book_edit->book_description_ar; ?></textarea>
                                <?php echo form_error('book_description_ar','<span class="text-danger">','</span>'); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                        $variant_res = $this->common_model->getData('tbl_variant', array('variant_status'=>'1'), 'multi');
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
                                            </div>
                                            <?php
                                        }
                                    }
                                ?>
                                <?php
                            }
                        } 
                    ?>
                </div>
                <!-- /.box-body -->      
                <div class="box-footer">
                    <a class="btn btn-danger btn-sm" href="<?php echo base_url() ;?>admin/book"><?php echo $myobj->loadPo('Cancel'); ?></a>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</aside>
<!-- /.right-side -->