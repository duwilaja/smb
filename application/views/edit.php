<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$base_url=base_url();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="<?php echo $base_url;?>cuba/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo $base_url;?>cuba/assets/images/favicon.png" type="image/x-icon">
    <title>Smart Management</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
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
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>cuba/assets/css/vendors/scrollbar.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>cuba/assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>cuba/assets/css/style.css">
    <link id="color" rel="stylesheet" href="<?php echo $base_url;?>cuba/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>cuba/assets/css/responsive.css">
	
	<!-- Select2 css -->
		<link href="<?php echo $base_url;?>cuba/assets/css/vendors/select2.css" rel="stylesheet" />
	<!-- datatables CSS-->
		<!--link rel="stylesheet" href="my/vendor/datatables/datatables.min.css"-->
		<link rel="stylesheet" href="<?php echo $base_url;?>my/vendor/datatables.net-bs4/dataTables.bootstrap4.css">
		<link rel="stylesheet" href="<?php echo $base_url;?>my/vendor/datatables-buttons/css/buttons.bootstrap4.min.css">
		
		<!-- bootstrap CSS-->
		<link rel="stylesheet" href="<?php echo $base_url;?>my/vendor/bootstrap/css/bootstrap-select.min.css">
		<link rel="stylesheet" href="<?php echo $base_url;?>my/vendor/bootstrap/css/bootstrap-datetimepicker.min.css">
		<link rel="stylesheet" href="<?php echo $base_url;?>my/vendor/bootstrap/css/yearpicker.css">
		
		<!-- fancybox CSS-->
		<link rel="stylesheet" href="<?php echo $base_url;?>my/vendor/jquery-fancybox/jquery.fancybox.min.css">
		<link rel="stylesheet" href="<?php echo $base_url;?>my/vendor/leaflet/leaflet.css" />
		<link rel="stylesheet" href="<?php echo $base_url;?>my/vendor/leaflet/leaflet.awesome-markers.css" />
		
	
	<style type="text/css">
		.hidden{
			display: none;
		}
        .form-group{
		margin-top: 8px;
	}
        .dataTables_wrapper .dataTables_length {
            margin-bottom: 0 !important;
        }
        .dt-buttons.btn-group.flex-wrap{
            float: right;
        }
		
		.select2-dropdown{
			z-index: 9999;
		}
	</style>
</head>

<body>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->

    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper color-sidebar" id="pageWrapper">
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <div class="page-body">
                <div class="container-fluid">
					
<!-- Row -->
<div class="row justify-content-center">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Edit</h3>
				
			</div>
			<div class="card-body"><form name="myf" id="myf">
						
<!--hidden-->
<input type="hidden" name="rowid" id="rowid" value="0" />
<input type="hidden" name="nrp" value="<?php echo $session['nrp']?>">
<input type="hidden" name="polda" value="<?php echo $session['polda']?>">
<input type="hidden" name="polres" value="<?php echo $session['polres']?>">
<input type="hidden" name="dinas" value="<?php echo $session['dinas']?>">
<input type="hidden" name="subdinas" value="<?php echo $session['subdinas']?>">
<input type="hidden" name="unit" value="<?php echo $session['unit']?>">
<input type="hidden" name="tgl" value="<?php echo date('Y-m-d')?>">

				<div class="dimmer active ldr hidden">
					<div class="sk-cube-grid">
						<div class="sk-cube sk-cube1"></div>
						<div class="sk-cube sk-cube2"></div>
						<div class="sk-cube sk-cube3"></div>
						<div class="sk-cube sk-cube4"></div>
						<div class="sk-cube sk-cube5"></div>
						<div class="sk-cube sk-cube6"></div>
						<div class="sk-cube sk-cube7"></div>
						<div class="sk-cube sk-cube8"></div>
						<div class="sk-cube sk-cube9"></div>
					</div>
				</div>
				<div id="isilaporan">

				</div>
			</form></div>
			<div class="card-footer text-right">
				<button type="button" id="btn_save" class="btn btn-primary" onclick="simpanlah();">Simpan Laporan</button>
				<button type="button" id="btn_dele" class="btn btn-danger hidden" onclick="hapuslah();">Hapus Laporan</button>
			</div>
		</div>
	</div>
</div>
<!-- End Row-->



                </div>
                <!-- Container-fluid Ends-->
            </div>
        </div>
    </div>

    <!-- latest jquery-->
    <script src="<?php echo $base_url;?>cuba/assets/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap js-->
    <script src="<?php echo $base_url;?>cuba/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="<?php echo $base_url;?>cuba/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="<?php echo $base_url;?>cuba/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <script src="<?php echo $base_url;?>cuba/assets/js/scrollbar/simplebar.js"></script>
    <script src="<?php echo $base_url;?>cuba/assets/js/scrollbar/custom.js"></script>
    <!-- Sidebar jquery-->
    <script src="<?php echo $base_url;?>cuba/assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="<?php echo $base_url;?>cuba/assets/js/sidebar-menu.js"></script>
    <script src="<?php echo $base_url;?>cuba/assets/js/tooltip-init.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="<?php echo $base_url;?>cuba/assets/js/script.js"></script>
    <!-- <script src="<?php echo $base_url;?>cuba/assets/js/theme-customizer/customizer.js"></script> -->
    <!-- login js-->
    <!-- Plugin used-->

<!-- FIREBASE -->
		<script src="https://www.gstatic.com/firebasejs/8.4.2/firebase-app.js"></script>

		<script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-messaging.js"></script>
		<script src="<?= base_url('my/js_local/local.js');?>"></script>

	<!--Select2 js -->
	<script src="<?php echo $base_url;?>cuba/assets/js/select2.full.min.js"></script>
		
	<script src="<?php echo $base_url;?>my/vendor/bootstrap/js/moment.min.js"></script>
    <script src="<?php echo $base_url;?>my/vendor/bootstrap/js/bootstrap-select.min.js"></script>
    <script src="<?php echo $base_url;?>my/vendor/bootstrap/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?php echo $base_url;?>my/vendor/bootstrap/js/yearpicker.js"></script>
    
	<script src="<?php echo $base_url;?>my/vendor/datatables/datatables.min.js"></script>
    <script src="<?php echo $base_url;?>my/vendor/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="<?php echo $base_url;?>my/vendor/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo $base_url;?>my/vendor/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo $base_url;?>my/vendor/datatables-buttons/js/buttons.html5.min.js"></script>
	<script src="<?php echo $base_url;?>my/vendor/datatables-buttons/js/jszip.min.js"></script>
	
    <script src="<?php echo $base_url;?>my/vendor/swal2/sweetalert.min.js"></script>
    <script src="<?php echo $base_url;?>my/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?php echo $base_url;?>my/vendor/jquery-fancybox/jquery.fancybox.min.js"></script>
    <script src="<?php echo $base_url;?>my/vendor/chart.js/Chart.min.js"></script>
	
	<script src="<?php echo base_url();?>my/vendor/leaflet/leaflet.js"></script>
	<script src="<?php echo base_url();?>my/vendor/leaflet/leaflet.awesome-markers.min.js"></script>
	
	<?php if(@$js_local){ ?>
		<script src="<?= base_url('my/js_local/'.$js_local);?>"></script>
	<?php } ?>
    
	<!-- global vars -->
	<script>
	var ext='';
	var page='';
	var base_url='<?php echo $base_url;?>';
	var recid=<?php echo $i;?>;
	var view='<?php echo $t;?>';
	</script>
	
	<!-- my own custom js -->
	<script src="<?php echo $base_url;?>my/js/custom_dw.js"></script>
	
<!-- this page's JavaScript -->
<script>
var jvalidate=null;
$(document).ready(function(){
	page_ready();
	if(typeof(thispage_ready)=='function'){
		thispage_ready();
		$("#pageWrapper").removeClass("compact-wrapper dark-sidebar");
	}
});

function simpanlah(){
	if(typeof(safeform)=="function"){
		safeform('#myf'); //sendData to the specific controller/function
	}else{
		sendData('#myf','laporan/save');
	}
}
function hapuslah(){
	if(typeof(delform)=="function"){
		delform('#myf'); //sendData to the specific controller/function
	}else{
		sendData('#myf','laporan/dele');
	}
}
function thispage_ready(){
	get_contentx('laporan/get_content',{id:view},'.ldr','#isilaporan');
}
function get_contentx(url,data,ldr,target,mthd='POST'){
	$(target).hide();
	$(ldr).show();
	$.ajax({
		type: mthd,
		url: base_url+url,
		data: data,
		success: function(result){
			$(ldr).hide();
			$(target).html(result).show();
			getRec();
			if(typeof(contentcallback)=='function') contentcallback(true);
		},
		error: function(xhr){
			$(ldr).hide();
			alrt('Error loading content','error','Error');
			if(typeof(contentcallback)=='function') contentcallback(false);
		}
	});
}
function getRec(){
	$.ajax({
		type: 'POST',
		url: base_url+'edit/get',
		data: {q:view,id:recid},
		success: function(data){
			var json = JSON.parse(data);
			if(json['code']=='200'){
				$.each(json['msgs'][0],function (key,val){
					$("[name='"+key+"']").val(val);
				});
				subQ(json);
				$("#btn_dele").show();
			}else{
				log(json['msgs']);
			}
		},
		error: function(xhr){
			log('Please check your connection'+xhr);
		}
	});
}
function subQ(dats){
	var dat=dats['msgs'][0];
	if(view=='tmc_ops_pol'||view=='tmc_ops_macet'){
		getSubQ('laporan/get_subq',$("#penyebab").val(),'#penyebabd',dat['penyebabd'],'','penyebab_macet_d','detil as v,detil as t','sebab');
	}
	if(view=='tmc_rengiat_vip'){
		var sub=dats['sub'];
		log(sub);
		for(var i=0;i<sub.length;i++){
			var d=sub[i];
			var lastchild=$("tbody").children().last();
			var flds=lastchild.find("input");
			flds[0].value=d['nama'];
			flds[1].value=d['gangguan'];
			flds[2].value=d['gangguan'];
			flds[3].value=d['ejarak'];
			flds[4].value=d['ewaktu'];
			flds[5].value=d['transit'];
			flds[6].value=d['lat'];
			flds[7].value=d['lng'];
			
			lastchild.find("select.select2").trigger("change");
			
			klon();
		}
	}
}
</script>

  </body>
</html>
