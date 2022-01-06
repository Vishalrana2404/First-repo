   <div class="banner-area banner-bg-1">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="banner">
                  <h2><?php echo $myobj->loadPo('About Us'); ?></h2>
               </div>
            </div>
         </div>
      </div>
   </div>


   <div class="hsub_heading_sub">
    <div class="container">
     <p class="home_head">منزل ! <span class="categfo"> حول</span></p>
    </div>
   </div>
<?php
    $page_res = $this->common_model->getData('tbl_page', array('page_id'=>'1'), 'single');
?>

    <section class="about_part">
     <div class="container">
     <div class="row">
      <div class="col-lg-7 col-md-7 or_der">
          <div class="about_content_in_new">
             <h5 class="hav_in_te"></h5>
             <p>
                 <?php echo ($lng == 'ara') ? $page_res->section_ar_1 : $page_res->section_1; ?>
             </p>
          </div>
       </div>
       <div class="col-lg-5 col-md-5 or_der_bottom">
        <div class="about_part_image">
           <img src="<?php echo base_url().$page_res->section_img_1; ?>" alt="img">
        </div>
       </div>
       </div>
      <div class="row">
       <div class="col-lg-5 col-md-5">
        <div class="about_part_image">
           <img src="<?php echo base_url().$page_res->section_img_2; ?>" alt="img">
        </div>
       </div>
       <div class="col-lg-7 col-md-7">
          <div class="about_content_in_new">
             <p>
                 <?php echo ($lng == 'ara') ? $page_res->section_ar_2 : $page_res->section_2; ?>
             </p>
          </div>
       </div>
       
     </div>
    </div>
   </section>

   <section class="about_bottom_in_new">
    <div class="container">
     <div class="bor_de">
      <div class="row">
       <div class="col-lg-6">
        <div class="content_new_about">
           <h5 class="lorm_about"></h5>
            <p>
                 <?php echo ($lng == 'ara') ? $page_res->section_ar_3 : $page_res->section_3; ?>
             </p>
        </div>
       </div>
       <div class="col-lg-6">
        <div class="content_new_about">
        
           <h5 class="lorm_about"></h5>
            <p>
                 <?php echo ($lng == 'ara') ? $page_res->section_ar_4 : $page_res->section_4; ?>
             </p>
        </div>
       </div>
      </div>
     </div>
    </div>
   </section>