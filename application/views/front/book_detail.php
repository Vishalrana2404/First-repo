<div class="banner-area banner-bg-2">

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <div class="banner">

                    <h2><?php echo $myobj->loadPo('Book details'); ?></h2>

                    <ul class="page-title-link">

                        <li><a href="#"<?php echo $myobj->loadPo('Home'); ?>></a></li>

                        <li><span class="color"><?php echo ($lng == 'ara') ? $book_res->book_name_ar : $book_res->book_name; ?></span></li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="hsub_heading_sub">

    <div class="container">

        <p class="home_head">الصفحة الرئيسية ! <span class="categfo">فاصيل الكتاب</span></p>

    </div>

</div>

<div class="container">

    <div class="card-wrapper">

        <div class="card card_product">

            <div class="row">

                <div class="col-lg-6 rate_in">

                    <div class="product-content">

                        <h2 class="featured"><?php echo ($lng == 'ara') ? $book_res->book_name_ar : $book_res->book_name; ?></h2>

                        <p class="lead">

                            <?php 

                                $auther_detail = $this->common_model->getData('tbl_authors', array('authors_id'=>$book_res->authors_id), 'single');

                                if(!empty($auther_detail)){

                                   echo ($lng == 'ara') ? $myobj->loadPo('By').' '.$auther_detail->authors_name_ar.' ('.$myobj->loadPo('Author').')' : $myobj->loadPo('By').' '.$auther_detail->authors_name.' ('.$myobj->loadPo('Author').')';

                                }

                            ?>

                        </p>

                        <?php

                            if($book_res->book_top_rating == '1'){

                                ?>

                                <span class="star">

                                <i class="fa fa-star" aria-hidden="true"></i>

                                <i class="fa fa-star-o" aria-hidden="true"></i>

                                <i class="fa fa-star-o" aria-hidden="true"></i>

                                <i class="fa fa-star-o" aria-hidden="true"></i>

                                <i class="fa fa-star-o" aria-hidden="true"></i> 

                                </span>

                                <?php

                            }

                            elseif($book_res->book_top_rating == '2'){

                                ?>

                                <span class="star">

                                <i class="fa fa-star" aria-hidden="true"></i>

                                <i class="fa fa-star" aria-hidden="true"></i>

                                <i class="fa fa-star-o" aria-hidden="true"></i>

                                <i class="fa fa-star-o" aria-hidden="true"></i>

                                <i class="fa fa-star-o" aria-hidden="true"></i> 

                                </span>

                                <?php

                            }

                            elseif($book_res->book_top_rating == '3'){

                                ?>

                                <span class="star">

                                <i class="fa fa-star" aria-hidden="true"></i>

                                <i class="fa fa-star" aria-hidden="true"></i>

                                <i class="fa fa-star" aria-hidden="true"></i>

                                <i class="fa fa-star-o" aria-hidden="true"></i>

                                <i class="fa fa-star-o" aria-hidden="true"></i> 

                                </span>

                                <?php

                            }

                            elseif($book_res->book_top_rating == '4'){

                                ?>

                                <span class="star">

                                <i class="fa fa-star" aria-hidden="true"></i>

                                <i class="fa fa-star" aria-hidden="true"></i>

                                <i class="fa fa-star" aria-hidden="true"></i>

                                <i class="fa fa-star" aria-hidden="true"></i>

                                <i class="fa fa-star-o" aria-hidden="true"></i> 

                                </span>

                                <?php

                            }

                            elseif($book_res->book_top_rating == '5'){

                                ?>

                                <span class="star">

                                <i class="fa fa-star" aria-hidden="true"></i>

                                <i class="fa fa-star" aria-hidden="true"></i>

                                <i class="fa fa-star" aria-hidden="true"></i>

                                <i class="fa fa-star" aria-hidden="true"></i>

                                <i class="fa fa-star" aria-hidden="true"></i> 

                                </span>

                                <?php

                            }

                            else{

                                ?>

                                <span class="star">

                                <i class="fa fa-star-o" aria-hidden="true"></i>

                                <i class="fa fa-star-o" aria-hidden="true"></i>

                                <i class="fa fa-star-o" aria-hidden="true"></i>

                                <i class="fa fa-star-o" aria-hidden="true"></i>

                                <i class="fa fa-star-o" aria-hidden="true"></i> 

                                </span>

                                <?php

                            }

                        ?>

                        <p class="lead lead_align">QR <?php echo $book_res->book_price; ?>&nbsp;&nbsp;</p>

                        <br>

                        <span  onclick="addToCart('<?php echo $book_res->book_id; ?>');" class="btn btn-light btn-radius btn-brd grd1 add_to_cart"><?php echo $myobj->loadPo('Add to Cart'); ?> </span>

                        <span onclick="addToWishList('<?php echo $book_res->book_id; ?>');" class="btn btn-light btn-radius btn-brd grd1 leve"><?php echo $myobj->loadPo('Buy Now'); ?></span>

                        <p class=""><?php echo $myobj->loadPo('SHARE THIS PRODUCT'); ?></p>

                        <span class="iconsocial">

                            <div class="facebook">  

                                <a class="icon_in" href="#"><i class="fa fa-twitter"></i></a>  

                            </div>

                            <div class="facebook">  

                                <a class="icon_in" href="#"><i class="fab fa-whatsapp"></i></a>

                            </div>

                            <div class="facebook">  

                                <a class="icon_in" href="#"><i class="fa fa-instagram"></i></a>

                            </div>

                            <div class="facebook">  

                                <a class="icon_in" href="#"><i class="fa fa-facebook-f"></i></a>

                            </div>

                        </span>

                        <br>

                        <div class="row">

                            <div class="col-md-12">

                                <p class="hibcvc"><?php echo $myobj->loadPo('SERVICES'); ?></p>

                            </div>

                        </div>

                        <div class="row text-center ald">

                            <div class="col-lg-3 col-md-3 col-4">

                                <center> <img src="<?php echo base_url(); ?>webroot/front/images/icon-returns.png" alt="" class="img-responsive img-rounded imgicon"></center>

                                <p class="text">10 <?php echo $myobj->loadPo('Days Replacement'); ?></p>

                            </div>

                            <div class="col-lg-3 col-md-3 col-4">

                                <center>  <img src="<?php echo base_url(); ?>webroot/front/images/icon-amazon-delivered.png" alt="" class="img-responsive img-rounded imgicon"> </center>

                                <p class="text"><?php echo $myobj->loadPo('Free Home Delivery'); ?></p>

                            </div>

                            <div class=" col-lg-3 col-md-3 col-4">

                                <center>  <img src="<?php echo base_url(); ?>webroot/front/images/icon-returns.png" alt="" class="img-responsive img-rounded imgicon"> </center>

                                <p class="text"><?php echo $myobj->loadPo('No Contact Delivery'); ?></p>

                            </div>

                            <div class=" col-md-3 ">

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-6 slide_in">

                    <div class="slideshow">

                        <div class="owl-carousel owl-theme owl-loaded owl-slid">

                            <div class="owl-stage-outer">

                                <div class="owl-stage">

                                    <?php

                                        $book_img = $this->common_model->getData('tbl_book_img', array('book_id'=>$book_res->book_id, 'book_img_status'=>'1'), 'multi');

                                        if(!empty($book_img)){

                                            foreach($book_img as $bi_val){

                                                ?>

                                                <div class="owl-item"><img src="<?php echo base_url().$bi_val->book_img; ?>" class="image-fit" alt="img"></div>

                                                <?php

                                            }

                                        }

                                        else{

                                            ?>

                                            <div class="owl-item"><img src="<?php echo base_url().$book_res->book_img; ?>" class="image-fit" alt="img"></div>

                                            <?php

                                        }

                                    ?>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<section class="tab_book_detail">

    <div class="container">

        <ul class="tabs">

            <li class="tab-link current" data-tab="tab-1">نبذة عن الكتاب</li>

            <li class="tab-link" data-tab="tab-2">علامة التبويب الثانية</li>

        </ul>

        <div id="tab-1" class="tab-content current">

            <?php echo ($lng == 'ara') ? $book_res->book_description_ar : $book_res->book_description; ?>

        </div>

        <div id="tab-2" class="tab-content">

            <?php echo ($lng == 'ara') ? $book_res->book_description_ar : $book_res->book_description; ?>

        </div>

    </div>

</section>

<section class="slid_book">

    <div class="container">

        <div class="bokhead">

            <div class="sectionHead">

                <h3 class="featured">كتب مميزة </h3>

                <div class="menuCat akign_in">

                    <ul>

                        <li><a href="<?php echo base_url(); ?>top_rated_book">الأفضل </a></li>

                        <li><a href="<?php echo base_url(); ?>bookList"><?php echo $myobj->loadPo('View All'); ?></a></li>

                    </ul>

                </div>

            </div>

        </div>

        <div class="slideshow">

            <div class="owl-carousel owl-theme owl-loaded owl-slid_1">

                <div class="owl-stage-outer">

                    <div class="owl-stage">

                        <?php

                            $similar_book = $this->common_model->getData('tbl_book', array('book_status'=>'1', 'authors_id'=>$book_res->authors_id), 'multi', NULL, 'book_id DESC', '8');

                            if(!empty($similar_book)){

                                $i=1;

                                foreach($similar_book as $s_val){

                                    ?>

                                    <div class="owl-item">

                                        <a href="<?php echo base_url().'book_detail/'.$s_val->book_id; ?>">

                                            <div class="card zoom">

                                                <img src="<?php echo base_url().$s_val->book_img; ?>" alt="" class="img-responsive img-rounded">

                                                <div class="shopBag" onclick="addToWishList('<?php echo $s_val->book_id; ?>');" >

                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>

                                                </div>

                                                <div class="pad_in">

                                                    <div class="had_in">


                                                            <h4><b><?php echo ($lng == 'ara') ? $s_val->book_name_ar : $s_val->book_name; ?></b></h4>



                                                    </div>

                                                    <p class="mb-0">

                                                        <?php 

                                                            $auther_detail = $this->common_model->getData('tbl_authors', array('authors_id'=>$s_val->authors_id), 'single');

                                                            if(!empty($auther_detail)){

                                                               echo ($lng == 'ara') ? $auther_detail->authors_name_ar : $auther_detail->authors_name;

                                                            }

                                                        ?>

                                                    </p>

                                                    <div class="container">

                                                        <!--<h4><b><?php echo ($lng == 'ara') ? $s_val->book_name_ar : $s_val->book_name; ?></b></h4>-->


                                                                <div class="shopBag_1" onclick="addToCart('<?php echo $s_val->book_id; ?>');">

                                                                    <div class="ro_ic">
                                                                        <b class="qar">QR <?php echo $s_val->book_price; ?></b> 
                                                                        
                                                                    </div>

                                                                    <img src="https://www.crazywebdesigners.com/bookstore_v1/webroot/front/images/shopping-bag.svg" alt="">

                                                                </div>
                                                    </div>

                                                </div>

                                            </div>

                                        </a>

                                    </div>

                                    <?php

                                }

                            }

                        ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<style type="text/css">

    *{

    margin: 0;

    padding: 0;

    }

    .rate {

    float: left;

    height: 46px;

    padding: 0 10px;

    }

    .rate:not(:checked) > input {

    position:absolute;

    top:-9999px;

    }

    .rate:not(:checked) > label {

    float:right;

    width:1em;

    overflow:hidden;

    white-space:nowrap;

    cursor:pointer;

    font-size:30px;

    color:#ccc;

    }

    .rate:not(:checked) > label:before {

    content: '★ ';

    }

    .rate > input:checked ~ label {

    color: #ffc700;    

    }

    .rate:not(:checked) > label:hover,

    .rate:not(:checked) > label:hover ~ label {

    color: #deb217;  

    }

    .rate > input:checked + label:hover,

    .rate > input:checked + label:hover ~ label,

    .rate > input:checked ~ label:hover,

    .rate > input:checked ~ label:hover ~ label,

    .rate > label:hover ~ input:checked ~ label {

    color: #c59b08;

    }

</style>

<!-- Modal -->

<div id="myModal" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Write Review</h4>

            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-md-12">

                        <label><?php echo $myobj->loadPo('Rating'); ?></label><br>

                        <div class="rate">

                            <input type="radio" onclick="setReviewVal(this.value)" id="star5" name="rate" value="5" />

                            <label for="star5" title="text">5 stars</label>

                            <input type="radio" onclick="setReviewVal(this.value)" id="star4" name="rate" value="4" />

                            <label for="star4" title="text">4 stars</label>

                            <input type="radio" onclick="setReviewVal(this.value)" id="star3" name="rate" value="3" />

                            <label for="star3" title="text">3 stars</label>

                            <input type="radio" onclick="setReviewVal(this.value)" id="star2" name="rate" value="2" />

                            <label for="star2" title="text">2 stars</label>

                            <input type="radio" onclick="setReviewVal(this.value)" id="star1" name="rate" value="1" />

                            <label for="star1" title="text">1 star</label>

                        </div>

                        <input type="hidden" name="book_review" id="book_review" value="1">

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <label><?php echo $myobj->loadPo('Review'); ?></label><br>

                        <textarea class="form-control" name="book_review_description" id="book_review_description" rows="6"></textarea>

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <span onclick="writeReviews(<?php echo $book_res->book_id; ?>);" class="button btn btn-light btn-radius btn-brd wirte"> <?php echo $myobj->loadPo('Submit'); ?></span>

                <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Close</button>

            </div>

        </div>

    </div>

</div>

<?php 

    $advertisment_res = $this->common_model->getData('tbl_advertisement', array('advertisement_status'=>'1', 'advertisement_start_date >='=>date('Y-m-d'), 'advertisement_end_date <='=>date('Y-m-d')), 'single', NULL, 'rand()', '1');

    if(!empty($advertisment_res)){

       ?>

<div class="container">

    <section class="section lb align_garb">

        <div class="parallax section parallax-off pt cc-container" data-stellar-background-ratio="0.9" style="background-image:url('<?php echo base_url().$advertisment_res->advertisement_img; ?>');">

            <div class="row">

                <!-- <div class="col-lg-6">

                    <h1 class="homepage-three-title">Grab now </h1>

                    <h1 class="now">Great deals on books</h1>

                    <div class="slider-content-btn"> <a class="button btn btn-light btn-radius btn-brd" href="#">Click Here</a> </div>

                    </div> -->

            </div>

        </div>

    </section>

</div>

<?php    

    }

    ?>

<script>

    function setReviewVal(r_val){

       $('#book_review').val(r_val)

    }

    const imgs=document.querySelectorAll('.img-select a');

    const imgBtns=[...imgs];

    let imgId=1;

    imgBtns.forEach((imgItem) => {

       imgItem.addEventListener('click', (event) => {

          event.preventDefault();

          imgId=imgItem.dataset.id;

          slideImage();

       });

    });

    function slideImage(){

       const displayWidth=document.querySelector('.img-showcase img:first-child').clientWidth;

       document.querySelector('.img-showcase').style.transform=`translateX(${- (imgId - 1) * displayWidth}px)`;

    }

    window.addEventListener('resize', slideImage);

    var limit = '2';

    function reviewData(limit, offset) 

    {

       var lng = "<?php echo $lng; ?>";

       var book_id = "<?php echo $book_res->book_id; ?>";

       var PAGE = '<?php echo base_url(); ?>home/reviewData';

       jQuery.ajax({

          type :"POST",

          url  :PAGE,

          data :{limit:limit, offset:offset, lng:lng, book_id:book_id},

          success:function(response)

          {    

             jQuery('#review_data').html(response);

             jQuery(".pagination").click(function(){

                var offset =jQuery(this).data("id");

                reviewData(limit, offset);

             });

          } 

       });

    }

    reviewData(limit,0);

    function writeReviews(book_id){

       var book_review = $('#book_review').val();

       var book_review_description = $('#book_review_description').val();

       var str = "book_id="+book_id+"&book_review="+book_review+"&book_review_description="+book_review_description+"&<?php echo $this->security->get_csrf_token_name(); ?>="+"<?php echo $this->security->get_csrf_hash(); ?>";

       $.ajax({

          url: '<?= base_url()?>home/writeReviews',

          type: 'POST',

          data: str,

          dataType: 'json',

          cache: false,

          success: function(resp){

             if(resp.status == 'success')

             {

                toastr.success(resp.msg, 'Success!');

                setTimeout(function(){ 

                   window.location.href = "<?php echo base_url(); ?>";

                }, 1000);

             }

             else

             {

                setTimeout(function(){ 

                   window.location.href = "<?php echo base_url(); ?>";

                }, 1000);

                toastr.error(resp.msg,'Error!');

             }

          }

       });

    }

</script>