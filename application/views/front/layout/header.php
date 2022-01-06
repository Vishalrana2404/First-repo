<!doctype html>
<html lang="<?php if($lng == 'eng'){ echo 'en'; } else{ echo 'ar'; } ?>" dir="<?php if($lng == 'eng'){ } else{ echo 'rtl'; } ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title><?php echo $myobj->loadPo('Book Store'); ?></title>
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>webroot/front/images/logo.png" type="image/x-icon" />
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>webroot/front/images/apple-touch-icon.png">
        <?php 
            $lng = 'ara';
            if($lng == 'eng')
            { 
                ?>
                    <link rel="stylesheet" href="<?php echo base_url(); ?>webroot/front/css/bootstrap.min.css">
                    <link rel="stylesheet" href="<?php echo base_url(); ?>webroot/front/css/custom.css">
                <?php
            } 
            else{ 
                ?>
                    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.4.1/css/bootstrap.min.css" integrity="sha384-yQ02IR5BzpO2LZ70lJP2g4opr8tX6KzCmaELFzmNqlwtvTgtDJHQvuc43zCRMf1T" crossorigin="anonymous" />
                    <link rel="stylesheet" href="<?php echo base_url(); ?>webroot/front/css/custom_ar.css">
                <?php
            } 
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>webroot/front/js/mobile-menu.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>webroot/front/css/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>webroot/front/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>webroot/front/css/responsive.css">
        <script src="<?php echo base_url(); ?>webroot/front/js/modernizer.js"></script>
        <link href="<?php echo base_url(); ?>webroot/front/toastr/toastr.min.css" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo base_url(); ?>webroot/front/toastr/toastr.min.js"></script>
        <link href="https://db.onlinewebfonts.com/c/7d411bb0357d6fd29347455b7d207995?family=JF+Flat" rel="stylesheet" type="text/css"/>
        <link href="https://db.onlinewebfonts.com/c/80ef43d3685d74fc0e7ba8490cd6adc1?family=Avenir+LT+Pro" rel="stylesheet" type="text/css"/>
    </head>
    <body style="font-family:">
        <!---<div id="preloader">
            <div class="loader">
                <img src="<?php echo base_url(); ?>webroot/front/images/loader.png">
            </div>
        </div> --->
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-2 col-xs-3 plan">
                        <div class="open_search"><a href="#"><i class="fa fa-search"></i></a></div>
                        <div class="search_block">
                            <div class="search_box">
                                <div class="inner">
                                    <input type="text" name="search" id="search" class="search_input" autocomplete="off" placeholder="Cauta ceva in ograda ..." />
                                    <button class="search_icon glyphicon glyphicon-search"></button>
                                </div>
                            </div>
                            <div class="overlayer"></div>
                        </div>
                        <div class="left-top text-center">
                            <div class="serc_bar">
                                <form>
                                    <input class="fonrm-control" type="text" name="text">
                                    <span class="sec"><i class="fa fa-search"></i></span>
                                </form>
                            </div>
                            <div class="email-box">
                                <section>
                                    <!-----
                                    <form action="" method="POST" style="margin-bottom: 0;">
                                        <?php  $csrf = array( 'name' => $this->security->get_csrf_token_name(), 'hash' => $this->security->get_csrf_hash() ); ?>
                                        <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                                        <select  onchange="this.form.submit()" class="selectColor" name="lng">
                                            <option value="eng" <?php if($lng == 'eng'){ echo "selected"; } ?> > English</option>
                                            <option value="ara" <?php if($lng == 'ara'){ echo "selected"; } ?> >عربى</option>
                                        </select>
                                    </form> 
                                    ---->
                                </section>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4 col-sm-4 col-5 col-xs-3 mehths">
                        <div class="left-top">
                            <div class="phone-box"> 
                                <a href="<?php echo base_url(); ?>">
                                    <img src="<?php echo base_url(); ?>webroot/front/images/book_stor_logo.png" alt="image" class="logo">
                                    <img src="<?php echo base_url(); ?>webroot/front/images/book_stor_logo_mob.png" alt="image" class="logoMobile"> 
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-5 col-xs-6 any-hike">
                        <div class="right-top">
                            <div class="social-box listcolor headRightIco">
                                <ul>
                                    <li class="dropdown cartBox">
                                        <?php
                                            if($user_id){
                                                $wish_list = $this->common_model->getData('tbl_customer_whish_list', array('customer_id'=>$user_id, 'customer_wl_status'=>'1'), 'multi', NULL, 'customer_wl_id DESC', '5');
                                                if(!empty($wish_list)){
                                                    ?>
                                                    <a href="#" class="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><!-- <i class="fa fa-heart-o view-modal" aria-hidden="true"></i> -->
                                                    <img src="<?php echo base_url(); ?>webroot/front/images/heart.png" alt="img"><span class="cartNum"><?php echo count($wish_list); ?></span></a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                        <?php
                                                            foreach ($wish_list as $w_val) {
                                                                $book_res = $this->common_model->getData('tbl_book', array('book_id'=>$w_val->book_id), 'single');
                                                                if(!empty($book_res)){
                                                                    ?>
                                                                    <div class="itemAdded">
                                                                        <div class="img">
                                                                            <img src="<?php echo base_url().$book_res->book_img; ?>" alt="">
                                                                        </div>
                                                                        <div class="contentbx">
                                                                            <h6><?php echo ($lng == 'ara') ? $book_res->book_name_ar : $book_res->book_name; ?></h6>
                                                                            <p>
                                                                                <?php 
                                                                                    $auther_detail = $this->common_model->getData('tbl_authors', array('authors_id'=>$book_res->authors_id), 'single');
                                                                                    if(!empty($auther_detail)){
                                                                                        echo ($lng == 'ara') ? $auther_detail->authors_name_ar : $auther_detail->authors_name;
                                                                                    }
                                                                                ?>
                                                                            </p>
                                                                        </div>
                                                                        <a class="deleteBtn" onclick="removeWishList('<?php echo $w_val->book_id; ?>');"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                                    </div>
                                                                    <?php
                                                                }
                                                            }
                                                        ?>
                                                        </li>
                                                    </ul>
                                                    <?php
                                                }
                                            }
                                            else{
                                            }
                                        ?>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><!-- <i class="fa fa-user" aria-hidden="true"></i> --> <img src="<?php echo base_url(); ?>webroot/front/images/profile.png" alt="img"></a>
                                        <ul class="dropdown-menu setting">
                                            <li><a href="<?php echo base_url(); ?>login"><?php echo $myobj->loadPo('Login'); ?></a></li>
                                            <li><a href="<?php echo base_url(); ?>register"><?php echo $myobj->loadPo('Register'); ?></a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#"><!-- <i class="fa fa-heart-o" aria-hidden="true"></i> --> <img src="<?php echo base_url(); ?>webroot/front/images/heart.png" alt="img"></a></li>
                                    <li class="dropdown cartBox">
                                        <a href="#" class="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><!-- <i class="fa fa-shopping-cart view-modal" aria-hidden="true"></i> -->
                                        <img src="<?php echo base_url(); ?>webroot/front/images/bag.png" alt="img"><span class="cartNum"><?php echo $this->cart->total_items(); ?></span></a>
                                        <ul class="dropdown-menu cart_box_in_design">
                                            <li>
                                                <?php
                                                    $cart_res = $this->cart->contents();
                                                    if(!empty($cart_res)){
                                                        $total_amount = '0';
                                                        foreach($cart_res as $c_val){
                                                            $book_res = $this->common_model->getData('tbl_book', array('book_id'=>$c_val['id']), 'single');
                                                            if(!empty($book_res)){
                                                                ?>
                                                                    <div class="itemAdded">
                                                                        <a class="deleteBtn bot_in" onclick="removeCart('<?php echo $c_val['rowid']?>');"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                                        <div class="img">
                                                                            <img src="<?php echo base_url().$book_res->book_img; ?>" alt="">
                                                                        </div>
                                                                        <footer class="content content_cart">
                                                                            <span class="qt-minus" onclick="updateCart('minus', '<?php echo $c_val['rowid']?>');">-</span>
                                                                            <span class="qt"><?php echo $c_val['qty']; ?></span>
                                                                            <span class="qt-plus" onclick="updateCart('plus', '<?php echo $c_val['rowid']?>');">+</span>
                                                                        </footer>
                                                                        <div class="contentbx">
                                                                            <h6><?php echo ($lng == 'ara') ? $book_res->book_name_ar : $book_res->book_name; ?></h6>
                                                                            <p>
                                                                                <?php 
                                                                                    $auther_detail = $this->common_model->getData('tbl_authors', array('authors_id'=>$book_res->authors_id), 'single');
                                                                                    if(!empty($auther_detail)){
                                                                                        echo ($lng == 'ara') ? $auther_detail->authors_name_ar : $auther_detail->authors_name;
                                                                                    }
                                                                                ?>
                                                                            </p>
                                                                            <h4><?php echo $c_val['qty']; ?>  * QAR <?php echo $book_res->book_price; ?></h4>
                                                                        </div>                                                  
                                                                    </div>
                                                                <?php
                                                                $total_amount = $total_amount + ($c_val['qty']*$c_val['price']);
                                                            }
                                                        }
                                                        ?>
                                                            <div class="btnSet">
                                                                <a href="<?php echo base_url(); ?>cartList" class="viewCartBtn btn btn-default btn-lg btn-block"><?php echo $myobj->loadPo('View Cart'); ?></a>
                                                                <!-- <a href="#!" class="checkoutBtn btn btn-default btn-lg btn-block"><?php echo $myobj->loadPo('Checkout'); ?></a> -->
                                                            </div>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                            <h6><?php echo $myobj->loadPo('Cart is empty'); ?></h6>
                                                            <a href="<?php echo base_url(); ?>bookList" class="viewCartBtn btn btn-default btn-lg btn-block"><?php echo $myobj->loadPo('Shop Now'); ?></a>
                                                        <?php
                                                    }
                                                ?>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <header class="header header_style_01">
            <nav class="megamenu navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <div class="dektop-menu">
                            <div class="menu" id="myTopnav">
                                <ul>
                                    <a href="javascript:void(0);" style="font-size:15px;" class="icon_in_header" onclick="openNav()">&#9776;</a>
                                    <li><a class="<?php if($uri_segment == ''){ echo 'active'; } ?>" href="<?php echo base_url(); ?>"><?php echo $myobj->loadPo('Home'); ?></a></li>
                                    <li class="category_main_drop"><a class="<?php if($uri_segment == 'category'){ echo 'active'; } ?>" href="<?php echo base_url(); ?>category"><?php echo $myobj->loadPo('Category'); ?></a>
                                        <ul class="category_drop_down">
                                            <?php
                                                $category_res = $this->common_model->getData('tbl_category', array('category_status'=>'1', 'parent_category_id'=>'0'), 'multi');
                                                if(!empty($category_res)){
                                                    foreach($category_res as $c_val) {
                                                        $sub_category_res = $this->common_model->getData('tbl_category', array('category_status'=>'1', 'parent_category_id'=>$c_val->category_id), 'multi');
                                                        if(!empty($sub_category_res)){
                                                            ?>
                                                            <li class="cat_drop"><a href="<?php echo base_url(); ?>category/<?php echo $c_val->category_id; ?>"><?php echo ($lng == 'ara') ? $c_val->category_name_ar : $c_val->category_name; ?></a>
                                                                <ul class="drop_second_in">
                                                                    <?php
                                                                        foreach($sub_category_res as $s_val) {
                                                                            $subS_category_res = $this->common_model->getData('tbl_category', array('category_status'=>'1', 'parent_category_id'=>$s_val->category_id), 'multi');
                                                                            if(!empty($subS_category_res)){
                                                                                ?>
                                                                                <li class="cat_drop_second"><a href="<?php echo base_url(); ?>category/<?php echo $s_val->category_id; ?>"><?php echo ($lng == 'ara') ? $s_val->category_name_ar : $s_val->category_name; ?></a>
                                                                                    <ul class="drop_third_in">
                                                                                        <?php
                                                                                            foreach($subS_category_res as $sS_val) {
                                                                                                ?>
                                                                                                    <li class="living"><a href="<?php echo base_url(); ?>category/<?php echo $sS_val->category_id; ?>"><?php echo ($lng == 'ara') ? $sS_val->category_name_ar : $sS_val->category_name; ?></a></li>
                                                                                                <?php
                                                                                            }
                                                                                        ?>
                                                                                    </ul>
                                                                                </li>
                                                                                <?php
                                                                            }
                                                                            else{
                                                                                ?>
                                                                                    <li class="living"><a href="<?php echo base_url(); ?>category/<?php echo $s_val->category_id; ?>"><?php echo ($lng == 'ara') ? $s_val->category_name_ar : $s_val->category_name; ?></a></li>
                                                                                <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </ul>
                                                            </li>
                                                            <?php
                                                        }
                                                        else{
                                                            ?>
                                                                <li class="cat_drop"><a href="<?php echo base_url(); ?>category/<?php echo $c_val->category_id; ?>"><?php echo ($lng == 'ara') ? $c_val->category_name_ar : $c_val->category_name; ?></a></li>
                                                            <?php
                                                        }
                                                    }
                                                }
                                            ?>
                                        </ul>
                                    </li>
                                    <li><a class="<?php if($uri_segment == 'about'){ echo 'active'; } ?>" href="<?php echo base_url(); ?>about"><?php echo $myobj->loadPo('About'); ?></a></li>
                                    <li><a class="<?php if($uri_segment == 'contact'){ echo 'active'; } ?>" href="<?php echo base_url(); ?>contact"><?php echo $myobj->loadPo('Contact'); ?></a></li>
                                    <li class="category_main_drop"><a class="" ><?php echo $myobj->loadPo('Helps'); ?></a>
                                        <ul class="category_drop_down">
                                            <li class="cat_drop"><a href="<?php echo base_url(); ?>termsanditions"><?php echo $myobj->loadPo('Terms & Condition'); ?></a></li>
                                            <!--<li><a href="<?php echo base_url(); ?>privacyPolicy"><?php echo $myobj->loadPo('Privacy Policy'); ?></a></li>--->
                                            <li class="cat_drop"><a href="<?php echo base_url(); ?>refundPolicy"><?php echo $myobj->loadPo('Refund Policy'); ?></a></li>
                                            <!---<li><a href="<?php echo base_url(); ?>orderReturnPolicy"><?php echo $myobj->loadPo('Order & Returns Policy'); ?></a></li>----->
                                            <li class="cat_drop"><a href="<?php echo base_url(); ?>faq"><?php echo $myobj->loadPo('FAQ'); ?></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="mySidenav" class="sidenav">
                            <ul>
                                <div class="logo_header_in">
                                    <a href="#"><img src="<?php echo base_url(); ?>webroot/front/images/book_stor_logo_mob.png" alt="image" class="logoMobile"></a>
                                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                                </div>
                                <li><a class="<?php if($uri_segment == ''){ echo 'active'; } ?>" href="<?php echo base_url(); ?>"><?php echo $myobj->loadPo('Home'); ?></a></li>
                                <li><a class="<?php if($uri_segment == 'category'){ echo 'active'; } ?>" href="<?php echo base_url(); ?>category"><?php echo $myobj->loadPo('Category'); ?><i class="fa fa-caret-down desktop_view_icon"></i></a>
                                    <ul>
                                        <?php
                                            $category_res = $this->common_model->getData('tbl_category', array('category_status'=>'1', 'parent_category_id'=>'0'), 'multi');
                                            if(!empty($category_res)){
                                                foreach($category_res as $c_val) {
                                                    $sub_category_res = $this->common_model->getData('tbl_category', array('category_status'=>'1', 'parent_category_id'=>$c_val->category_id), 'multi');
                                                    if(!empty($sub_category_res)){
                                                        ?>
                                                        <li><a href="<?php echo base_url(); ?>category/<?php echo $c_val->category_id; ?>"><?php echo ($lng == 'ara') ? $c_val->category_name_ar : $c_val->category_name; ?></a>
                                                            <ul>
                                                                <?php
                                                                    foreach($sub_category_res as $s_val) {
                                                                        $subS_category_res = $this->common_model->getData('tbl_category', array('category_status'=>'1', 'parent_category_id'=>$s_val->category_id), 'multi');
                                                                    if(!empty($subS_category_res)){
                                                                        ?>
                                                                        <li><a href="<?php echo base_url(); ?>category/<?php echo $s_val->category_id; ?>"><?php echo ($lng == 'ara') ? $s_val->category_name_ar : $s_val->category_name; ?></a>
                                                                            <ul>
                                                                                <?php
                                                                                    foreach($subS_category_res as $sS_val) {
                                                                                        ?>
                                                                                            <li><a href="<?php echo base_url(); ?>category/<?php echo $sS_val->category_id; ?>"><?php echo ($lng == 'ara') ? $sS_val->category_name_ar : $sS_val->category_name; ?></a></li>
                                                                                        <?php
                                                                                    }
                                                                                ?>
                                                                            </ul>
                                                                        </li>
                                                                        <?php
                                                                    }
                                                                    else{
                                                                        ?>
                                                                            <li><a href="<?php echo base_url(); ?>category/<?php echo $s_val->category_id; ?>"><?php echo ($lng == 'ara') ? $s_val->category_name_ar : $s_val->category_name; ?></a></li>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </ul>
                                                        </li>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                            <li><a href="<?php echo base_url(); ?>category/<?php echo $c_val->category_id; ?>"><?php echo ($lng == 'ara') ? $c_val->category_name_ar : $c_val->category_name; ?></a></li>
                                                        <?php
                                                    }
                                                }
                                            }
                                        ?>
                                    </ul>
                                </li>
                                <li><a class="<?php if($uri_segment == 'about'){ echo 'active'; } ?>" href="<?php echo base_url(); ?>about"><?php echo $myobj->loadPo('About'); ?></a></li>
                                <li><a class="<?php if($uri_segment == 'contact'){ echo 'active'; } ?>" href="<?php echo base_url(); ?>contact"><?php echo $myobj->loadPo('Contact'); ?></a></li>
                                <li><a class="" ><?php echo $myobj->loadPo('Helps'); ?></a>
                                    <ul>
                                        <li><a href="<?php echo base_url(); ?>termsanditions"><?php echo $myobj->loadPo('Terms & Condition'); ?></a></li>
                                        <li><a href="<?php echo base_url(); ?>refundPolicy"><?php echo $myobj->loadPo('Refund Policy'); ?></a></li>
                                        <li><a href="<?php echo base_url(); ?>faq"><?php echo $myobj->loadPo('FAQ'); ?></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="toggle_in">
                            <a href="#"><i class="fa fa-bars" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Mobile menu  -->
            <div class="mobile-menu">
               <div class="header">
                    <a href="#menu">&#9776;</a>
                    <nav id="menu">
                        <div class="logo_header_in">
                            <a href="#"><img src="<?php echo base_url(); ?>webroot/front/images/book_stor_logo_mob.png" alt="image" class="logoMobile"></a>
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        </div>
                        <ul>
                            <li><a class="<?php if($uri_segment == ''){ echo 'active'; } ?>" href="<?php echo base_url(); ?>"><?php echo $myobj->loadPo('Home'); ?></a></li>
                            <li><span class="<?php if($uri_segment == 'category'){ echo 'active'; } ?>"><?php echo $myobj->loadPo('Category'); ?><i class="fa fa-caret-down desktop_view_icon"></i></span>
                                <ul>
                                    <?php
                                        $category_res = $this->common_model->getData('tbl_category', array('category_status'=>'1', 'parent_category_id'=>'0'), 'multi');
                                        if(!empty($category_res)){
                                            foreach($category_res as $c_val) {
                                                $sub_category_res = $this->common_model->getData('tbl_category', array('category_status'=>'1', 'parent_category_id'=>$c_val->category_id), 'multi');
                                                if(!empty($sub_category_res)){
                                                    ?>
                                                    <li><span><?php echo ($lng == 'ara') ? $c_val->category_name_ar : $c_val->category_name; ?></span>
                                                        <ul>
                                                            <?php
                                                                foreach($sub_category_res as $s_val) {
                                                                    $subS_category_res = $this->common_model->getData('tbl_category', array('category_status'=>'1', 'parent_category_id'=>$s_val->category_id), 'multi');
                                                                    if(!empty($subS_category_res)){
                                                                        ?>
                                                                        <li><span><?php echo ($lng == 'ara') ? $s_val->category_name_ar : $s_val->category_name; ?></span>
                                                                            <ul>
                                                                                <?php
                                                                                    foreach($subS_category_res as $sS_val) {
                                                                                        ?>
                                                                                            <li><a href="<?php echo base_url(); ?>category/<?php echo $sS_val->category_id; ?>"><?php echo ($lng == 'ara') ? $sS_val->category_name_ar : $sS_val->category_name; ?></a></li>
                                                                                        <?php
                                                                                    }
                                                                                ?>
                                                                            </ul>
                                                                        </li>
                                                                        <?php
                                                                    }
                                                                    else{
                                                                        ?>
                                                                            <li><a href="<?php echo base_url(); ?>category/<?php echo $s_val->category_id; ?>"><?php echo ($lng == 'ara') ? $s_val->category_name_ar : $s_val->category_name; ?></a></li>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </ul>
                                                    </li>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                        <li><a href="<?php echo base_url(); ?>category/<?php echo $c_val->category_id; ?>"><?php echo ($lng == 'ara') ? $c_val->category_name_ar : $c_val->category_name; ?></a></li>
                                                    <?php
                                                }
                                            }
                                        }
                                    ?>
                                </ul>
                            </li>
                            <li><a class="<?php if($uri_segment == 'about'){ echo 'active'; } ?>" href="<?php echo base_url(); ?>about"><?php echo $myobj->loadPo('About'); ?></a></li>
                            <li><a class="<?php if($uri_segment == 'contact'){ echo 'active'; } ?>" href="<?php echo base_url(); ?>contact"><?php echo $myobj->loadPo('Contact'); ?></a></li>
                            <li><span class="" ><?php echo $myobj->loadPo('Helps'); ?><i class="fa fa-caret-down desktop_view_icon"></i></span>
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>termsanditions"><?php echo $myobj->loadPo('Terms & Condition'); ?></a></li>
                                    <!--<li><a href="<?php echo base_url(); ?>privacyPolicy"><?php echo $myobj->loadPo('Privacy Policy'); ?></a></li>--->
                                    <li><a href="<?php echo base_url(); ?>refundPolicy"><?php echo $myobj->loadPo('Refund Policy'); ?></a></li>
                                    <!---<li><a href="<?php echo base_url(); ?>orderReturnPolicy"><?php echo $myobj->loadPo('Order & Returns Policy'); ?></a></li>----->
                                    <li><a href="<?php echo base_url(); ?>faq"><?php echo $myobj->loadPo('FAQ'); ?></a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>