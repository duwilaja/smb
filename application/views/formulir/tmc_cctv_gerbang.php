<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,";
//$cols.="in_a,out_a,in_b,out_b,in_c,out_c,in_d,out_d,dominasi_a,dominasi_b,dominasi_c,dominasi_d";
$cols.="in_a,out_a,in_b,out_b,in_c,out_c,in_d,out_d,klasifikasi";
?>

<input type="hidden" name="tablename" value="tmc_cctv_gerbang">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">

<!--div class="row">
<div class="col-lg-12">
	<div class="btn-list">
		<?php 
		$keys=array_keys($subm);
		$values=array_values($subm);
		for($i=0;$i<count($keys);$i++){
		?>
		<button type="button" class="btn btn-warning btn-pill <?php echo $keys[$i]?>" onclick="ambil_isi('<?php echo $keys[$i]?>');"><i class="fa fa-list-alt"></i> <?php echo $values[$i]?></button>
		<?php } ?>
	</div>
</div>
</div>
<hr /-->

<div class="row">
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Masuk Gerbang A</label>
			<input type="text" name="in_a" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Keluar Gerbang A</label>
			<input type="text" id="lat" name="out_a" class="form-control" placeholder="" >
		</div>
	</div>
	<!--div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Dominasi Kendaraan</label>
			<select name="dominasi_a" class="form-control" placeholder="">
				<option value="Truk">Truk</option>
				<option value="Bus">Bus</option>
				<option value="Pribadi">Pribadi</option>
			</select>
		</div>
	</div>
</div>
<div class="row"-->
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Masuk Gerbang B</label>
			<input type="text" name="in_b" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Keluar Gerbang B</label>
			<input type="text" id="lat" name="out_b" class="form-control" placeholder="" >
		</div>
	</div>
	<!--div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Dominasi Kendaraan</label>
			<select name="dominasi_b" class="form-control" placeholder="">
				<option value="Truk">Truk</option>
				<option value="Bus">Bus</option>
				<option value="Pribadi">Pribadi</option>
			</select>
		</div>
	</div-->
</div>
<div class="row">
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Masuk Gerbang C</label>
			<input type="text" name="in_c" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Keluar Gerbang C</label>
			<input type="text" id="lat" name="out_c" class="form-control" placeholder="" >
		</div>
	</div>
	<!--div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Dominasi Kendaraan</label>
			<select name="dominasi_c" class="form-control" placeholder="">
				<option value="Truk">Truk</option>
				<option value="Bus">Bus</option>
				<option value="Pribadi">Pribadi</option>
			</select>
		</div>
	</div>
</div>
<div class="row"-->
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Masuk Gerbang D</label>
			<input type="text" name="in_d" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Keluar Gerbang D</label>
			<input type="text" id="lat" name="out_d" class="form-control" placeholder="" >
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Klasifikasi Kendaraan</label>
			<select name="klasifikasi" class="form-select" placeholder="">
				<option value="Truk">Truk</option>
				<option value="Bus">Bus</option>
				<option value="Pribadi">Pribadi</option>
				<option value="R2">R2</option>
			</select>
		</div>
	</div>
</div>

<script>
function mappicker(lat,lng){
	window.open(base_url+"map?lat="+$(lat).val()+"&lng="+$(lng).val(),"MapWindow","width=830,height=500,location=no").focus();
}
function lainnyabukan(tv){
	if(tv=='Lainnya'){
		$(".lainnya").show();
	}else{
		$("#lainnya").val("");
		$(".lainnya").hide();
	}
}
function macetgak(tv){
	if(tv=='Macet'){
		$(".macet").show();
	}else{
		$("#sebab").val("");
		$("#penggal").val("");
		$("#sumber").val("");
		$("#mulai").val("");
		$("#sampai").val("");
		$("#petugas").val("");
		$(".macet").hide();
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
		},
		"namajalan" : {
			required : true
		}
    }});

$("#btn_save").show();
$(".dasar").show();
$(".nomor").show();

datepicker(true);
timepicker();
macetgak('');

	$(".is-invalid").removeClass("is-invalid");
	$(".is-valid").removeClass("is-valid");

	$(".<?php echo $frid?>").attr("disabled",true);
</script>