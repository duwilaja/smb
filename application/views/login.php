<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$base_url = base_url();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="<?php echo $base_url;?>cuba/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo $base_url;?>cuba/assets/images/favicon.png" type="image/x-icon">
    <title>Smart Management</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>cuba/assets/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>cuba/assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>cuba/assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>cuba/assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>cuba/assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>cuba/assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>cuba/assets/css/style.css">
    <link id="color" rel="stylesheet" href="<?php echo $base_url;?>cuba/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>cuba/assets/css/responsive.css">
  </head>
  <body>
    <!-- login page start-->
    <div class="container-fluid">
      <div class="row">
        
        <div class="col-xl-7 d-flex justify-content-center" style="background-color: #f7f7f7;"><img class="bg-center" src="<?php echo $base_url;?>cuba/assets/login-vector.svg" alt="looginpage" width="700px"></div>
        <div class="col-xl-5 p-0">
          <div class="login-card">
            <div>
              <div><a class="logo text-start" href="index.html">SMART MANAGEMENT</a></div>
              <div class="login-main"> 
                <form class="theme-form" method="post" action="<?php echo $base_url;?>login">
                  <h4>Sign in to account</h4>
                  <p>Enter your ID & password to login</p>
                  <div class="form-group">
                    <label class="col-form-label">UserID/NRP</label>
                    <input class="form-control" type="text" name="user" required="" placeholder="">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Password</label>
                    <div class="form-input position-relative">
                      <input class="form-control" type="password" name="passwd" required="" placeholder="">
                      <div class="show-hide"><span class="show">                         </span></div>
                    </div>
                  </div>
                  <div class="form-group mb-0">
                    <div class=" p-0">
                      <!--input id="checkbox1" type="checkbox"-->
                      <a href="#" onclick="$('#modal_reset').modal('show');" data-toggle="modal" data-target="#modal_reset" class="ms-2"><label class="text-muted" for="checkbox1">Forgot password</label></a>
                    </div>
                    <button class="btn btn-primary btn-block w-100" type="submit">Sign in</button>
                  </div>
                  <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2" href="#" onclick="$('#modal_register').modal('show');" data-toggle="modal" data-target="#modal_register">Create Account</a></p>
                </form>
				<form id="login"></form>
              </div>
            </div>
          </div>
        </div>
      </div>
	  
	  <div class="modal fade modal_form" id="modal_register">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Register</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modal_register').modal('hide');">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
				<form id="register_form">
				  <div class="row">
				    <div class="form-group col-md-6">
						<label>Nama</label>
						<input type="text" name="nama" placeholder="..." class="form-control">
					</div>
					<div class="form-group col-md-6">
						<label>UserID/NRP</label>
						<input type="text" name="nrp" placeholder="..." class="form-control">
					</div>
				  </div>
				  <div class="row">
					<div class="form-group col-md-6">
						<label>Pangkat</label>
		<?php
		$opt=array('class'=>'form-control','id'=>'pangkat');
		echo form_dropdown('pangkat', array(), '', $opt);
		?>
					</div>
					<div class="form-group col-md-6">
						<label>Telp.</label>
						<input type="text" name="telp" placeholder="..." class="form-control">
					</div>
				  </div>
				  <div class="row">
				  </div>
				  <div class="row">
					<div class="form-group col-md-6">
						<label>Email</label>
						<input type="text" name="email" placeholder="..." class="form-control">
					</div>

				  </div>
				  <input type="hidden" name="zz" value="">
				  
				</form>
            </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="sendData('#register_form','account/register');">Register</button>
			</div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
	  
	  <div class="modal fade modal_form" id="modal_reset">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Reset Password</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#modal_reset').modal('hide');">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			<form id="reset_form">
			  <div class="row">
				<div class="form-group col-md-12">
					<label>UserID/NRP</label>
					<input type="text" name="rnip" placeholder="..." class="form-control">
				</div>
			  </div>
			  <!--div class="row">
				<div class="form-group col-md-12">
					<label>Email</label>
					<input type="text" name="remail" placeholder="..." class="form-control">
				</div>
			  </div-->
			</form>
            </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="sendData('#reset_form','account/forgot');">Reset My Password</button>
			</div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

	  
      <!-- latest jquery-->
      <script src="<?php echo $base_url;?>cuba/assets/js/jquery-3.5.1.min.js"></script>
      <!-- Bootstrap js-->
      <script src="<?php echo $base_url;?>cuba/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
      <!-- feather icon js-->
      <script src="<?php echo $base_url;?>cuba/assets/js/icons/feather-icon/feather.min.js"></script>
      <script src="<?php echo $base_url;?>cuba/assets/js/icons/feather-icon/feather-icon.js"></script>
      <!-- scrollbar js-->
      <!-- Sidebar jquery-->
      <script src="<?php echo $base_url;?>cuba/assets/js/config.js"></script>
      <!-- Plugins JS start-->
      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="<?php echo $base_url;?>cuba/assets/js/script.js"></script>
      <!-- login js-->
      <!-- Plugin used-->
	  <script src="<?php echo $base_url;?>my/vendor/bootstrap/js/moment.min.js"></script>
      <script src="<?php echo $base_url;?>my/vendor/bootstrap/js/bootstrap-select.min.js"></script>
      <script src="<?php echo $base_url;?>my/vendor/bootstrap/js/bootstrap-datetimepicker.min.js"></script>
      <script src="<?php echo $base_url;?>my/vendor/swal2/sweetalert.min.js"></script>
      <script src="<?php echo $base_url;?>my/vendor/jquery-validation/jquery.validate.min.js"></script>
    
    </div>
	
	<!-- global vars -->
	<script>
	var ext='.php';
	var page='';
	</script>
	<!-- my own custom js -->
	<script src="<?php echo $base_url;?>my/js/custom_dw.js"></script>
	
<!-- this page's JavaScript -->
<script>
<?php
$m=""; $x="";
if(isset($retval)){
	$m=$retval[2];
	$x=$retval[3];
}
?>
var x="<?php echo $x?>";
var m="<?php echo $m?>";

var base_url='<?php echo $base_url;?>';

var jvalidate, jvalidate2, jvalidate3;
$(document).ready(function (){
	$(".page-main").addClass("page-single");
	jvalidate = $("#login").validate({
    rules :{
        "user" : {
            required : true
        },
		"passwd" : {
			required : true
		}
    }});
	showAlert();
	
	jvalidate2 = $("#reset_form").validate({
    rules :{
        "rnip" : {
            required : true
        }/*,
		"remail" : {
			required : true,
			email: true
		}*/
    }});
	
	jvalidate3 = $("#register_form").validate({
    rules :{
        "nrp" : {
            required : true
        },
		"nama" : {
            required : true
        },
		"pangkat" : {
            required : true
        },
		"polres" : {
            required : true
        },
		"unit" : {
            required : true
        },
		"email" : {
			required : true,
			email: true
		}
    }});
	
	getSubQ('login/get_pangkat','','#pangkat');
});

function showAlert(){
	if(m!=""){
		alrt(m,x);
	}
}


</script>

	
  </body>
</html>