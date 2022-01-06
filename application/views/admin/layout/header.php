<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title><?php echo $myobj->loadPo('Book Store'); ?></title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.6 -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>webroot/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>webroot/css/jquery-ui.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>webroot/css/font-awesome.min.css">
      <!-- Calendar -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>webroot/plugins/fullcalendar/fullcalendar.min.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>webroot/plugins/fullcalendar/fullcalendar.print.css" media="print">
      <!-- Bootstrap time Picker -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>webroot/plugins/timepicker/bootstrap-timepicker.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="<?php echo base_url(); ?>webroot/css/AdminLTE.min.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>webroot/css/skin-blue.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>webroot/meo/meo.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>webroot/css/custom.css">
      <!-- jQuery 2.2.3 -->
      <script src="<?php echo base_url(); ?>webroot/plugins/jQuery/jquery-2.2.3.min.js"></script>
      <script src="<?php echo base_url(); ?>webroot/meo/meo.js"></script>
      <link rel="stylesheet" href="<?php echo base_url(); ?>webroot/css/bootstrap-select.min.css" />
      <link rel="stylesheet" href="<?php echo base_url(); ?>webroot/plugins/datatables/dataTables.bootstrap.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>webroot/js/tagit/bootstrap-tagsinput.css">
      <script src="<?php echo base_url(); ?>webroot/js/tagit/bootstrap-tagsinput.min.js"></script>
      <script src="<?php echo base_url(); ?>webroot/js/typeahead.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
      <style type="text/css">
         .textarea_view{
            background-color: #eee;
            border: 1px solid #eee;
            padding: 5px;
            display:inline-block;
            width: 100%
         }
         .pac-container {
            z-index: 10000 !important;
         }

         .switch {
           position: relative;
           display: inline-block;
           width: 60px !important;
           height: 34px;
         }

         .switch input { 
           opacity: 0;
           width: 0;
           height: 0;
         }

         .slider {
           position: absolute;
           cursor: pointer;
           top: 0;
           left: 0;
           right: 0;
           bottom: 0;
           background-color: #ccc;
           -webkit-transition: .4s;
           transition: .4s;
         }

         .slider:before {
           position: absolute;
           content: "";
           height: 26px;
           width: 26px;
           left: 4px;
           bottom: 4px;
           background-color: white;
           -webkit-transition: .4s;
           transition: .4s;
         }

         input:checked + .slider {
           background-color: #2196F3;
         }

         input:focus + .slider {
           box-shadow: 0 0 1px #2196F3;
         }

         input:checked + .slider:before {
           -webkit-transform: translateX(26px);
           -ms-transform: translateX(26px);
           transform: translateX(26px);
         }

         /* Rounded sliders */
         .slider.round {
           border-radius: 34px;
         }

         .slider.round:before {
           border-radius: 50%;
         }
      </style>
   </head>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">
         <header class="main-header">
            <!-- Logo -->
            <a href="<?php echo base_url().MODULE_NAME; ?>dashboard" class="logo">
            <?php echo $myobj->loadPo('Book Store'); ?>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
               <!-- Sidebar toggle button-->
               <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
               <span class="sr-only">Toggle navigation</span>
               </a>
               <h3 style="margin: 0px auto; text-align: center; width: auto; float: left; padding: 10px; color: #fff; "><?php echo $myobj->loadPo('Book Store'); ?></h3>

               <form action="" method="POST" style="margin-bottom: 0;">
                              <?php  $csrf = array( 'name' => $this->security->get_csrf_token_name(), 'hash' => $this->security->get_csrf_hash() ); ?>
                              <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                              <select  onchange="this.form.submit()" class="selectColor" name="lng">
                                 <option value="eng" <?php if($lng == 'eng'){ echo "selected"; } ?> > English</option>
                                 <option value="ara" <?php if($lng == 'ara'){ echo "selected"; } ?> >عربى</option>
                              </select>
                           </form>
               <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                     <!-- User Account: style can be found in dropdown.less -->
                     <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs"><?php echo $user_name; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                           <!-- User image -->
                           <li class="user-header">
                              <p><?php echo $user_name; ?></p>
                           </li>
                           <!-- Menu Footer-->
                           <li class="user-footer">
                              <div class="pull-left">
                                 <a href="<?php echo base_url().MODULE_NAME; ?>profile/index" class="btn btn-default btn-flat"><?php echo $myobj->loadPo('Profile'); ?></a>
                              </div>
                              <div class="pull-right">
                                 <a href="<?php echo base_url(); ?>login/logout" class="btn btn-default btn-flat"><?php echo $myobj->loadPo('Sign out'); ?></a>
                              </div>
                           </li>
                        </ul>
                     </li>
                    
                  </ul>
               </div>
            </nav>
         </header>
         <!-- Left side column. contains the logo and sidebar -->