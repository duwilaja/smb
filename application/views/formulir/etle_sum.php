<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,";
$cols.="total,tervalidasi,terberkas,terkirim,terkonfirmasi,terbayar,blokir";
?>

<input type="hidden" name="tablename" value="etle_sum">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">

<div class="row">
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Total</label>
			<input type="text" name="total" class="form-control">
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Tervalidasi</label>
			<input type="text" name="tervalidasi" class="form-control">
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Terberkas</label>
			<input type="text" name="terberkas" class="form-control">
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Terkirim</label>
			<input type="text" name="terkirim" class="form-control">
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Terkonfirmasi</label>
			<input type="text" name="terkonfirmasi" class="form-control">
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Terbayar</label>
			<input type="text" name="terbayar" class="form-control">
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Blokir STNK</label>
			<input type="text" name="blokir" class="form-control">
		</div>
	</div>
</div>

<script>
function jenischanged(tv){
	if(tv=='Yan Aduan'){
		$(".aduan").show();
	}else{
		$("#jenisd").val("");
		$(".aduan").hide();
	}
}
jvalidate = $("#myf").validate({
    rules :{
        "formulir" : {
            required : true
        },
		"dasar" : {
            required : true
        },
		"nomor" : {
			required : true
		}
    }});

$("#btn_save").show();
$(".dasar").show();
$(".nomor").show();

datepicker(true);
timepicker();
$(".yearpicker").yearpicker({});

$(".is-invalid").removeClass("is-invalid");
$(".is-valid").removeClass("is-valid");

</script>