<!DOCTYPE html>
<html>
<head>
	<title>Book Store</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo base_url(); ?>webroot/css/bootstrap.min.css">
	<script src="<?php echo base_url(); ?>webroot/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script src="<?php echo base_url(); ?>webroot/js/bootstrap.min.js"></script>
	<style type="text/css">
		body{
			background-image: url(webroot/bg.jpg);
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			height: 100vh;
		}
		.contact_box{
			width: 100%;
		    max-width: 400px;
		    margin: 0px auto;
		    margin-top: 23vh;
		    border: 1px solid #967462;
		    padding: 25px 15px 15px;
		    border-radius: 6px;
		    display: inline-block;
		    background: #fff;
		    /*background: rgba(245, 245, 245, 0.59);*/
		}
		.tab-content{
		}
		.nav-tabs>li {
		    float: left;
		    margin-bottom: -1px;
		    width: 100%;
		    border: 1px solid lightgray;
		    background: #967462;
		    border: 1px solid #967462;
		}
		.nav-tabs>li>a:hover {
		    border-color: transparent;
		}
		.nav>li>a:focus, .nav>li>a:hover {
		    text-decoration: none;
		    background-color: transparent;
		}
		.nav-tabs>li a,.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
		    color: #fff;
		    cursor:pointer;
		    background-color: transparent;
		    border: 0px solid #ddd; 
		    border-bottom-color: transparent;
		    text-align: center;
		    font-weight: bold;
		}
		.nav-tabs>li.active{
			background: #967462;
			border: 1px solid #967462;
		}
		.nav-tabs {
		    border-bottom: 0px solid #ddd;
		}
		.btn-primary {
		    color: #fff;
		    background-color:#967462;
		    border-color: #967462;
		    width: 100%;
		}
		.btn-primary:hover{
		    color: #fff;
		    background-color: #967462;
		    border-color: #967462;
		}
	</style>
</head>
<body>
	<div class="container" style="text-align: center;">
		<div class="contact_box">
			<div>
				<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>webroot/logo.png" height="70px;"></a>
			</div>
			<div id="login" class="tab-pane fade in active">
			  	<div class="form_area">
				  	<div class="form-area">  
				        <form action="<?php echo base_url(); ?>login/admin" method="post" id="login_form" accept-charset="utf-8">
	                        <?php  $csrf = array( 'name' => $this->security->get_csrf_token_name(), 'hash' => $this->security->get_csrf_hash() ); ?>
	                        <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
	                        <div id="msg_div">
	                        	<?php echo $this->session->flashdata('message'); ?>
	                        </div>
					        <br style="clear:both">
		    				<div class="form-group">
								<input required type="text" name="user_name" id="user_name" placeholder="Username" class="form-control">
                           	 	<?php echo form_error('user_name','<span class="text-danger">','</span>'); ?>
							</div>
							<div class="form-group">
								<input required type="password" name="user_password" id="user_password" placeholder="Password" class="form-control">
                            	<?php echo form_error('user_password','<span class="text-danger">','</span>'); ?>
							</div>     
							<div class="box-footer">
								<button class="btn btn-primary pull-right" type="submit" name="Login" value="Login" id="Login">Submit</button><br><br>
								<a class="btn btn-primary pull-right" href="<?php echo base_url() ;?>login/forgetPassword">Forget Password</a>
							</div>
					        <!-- <button type="submit" name="Login" id="Login" value="Login" class="btn btn-primary pull-right">Login</button> -->
				        </form>
				    </div>
			  	</div>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url(); ?>webroot/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script src="<?php echo base_url();?>webroot/js/dataencrypt.js" type="text/javascript"></script>
	<script>
		$("#msg_div").fadeOut(7000);
		$("#login_form").submit(function() 
		{
			var sh_pass = $('[name=user_password]').val();
			$('[name=user_password]').val(sha256(sh_pass));
		});
	</script>
</body>
</html>