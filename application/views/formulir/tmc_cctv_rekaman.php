<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,";
$cols.="organisasi,tanggal,lokasi,keperluan,lainnya";
?>

<input type="hidden" name="tablename" value="tmc_cctv_rekaman">
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
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Organisasi</label>
			<input type="text" name="organisasi" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Tgl Rekaman</label>
			<input type="text" name="tanggal" class="form-control datepicker" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-6">
		<div class="form-group">
			<label class="form-label">Lokasi CCTV</label>
			<textarea name="lokasi" class="form-control" placeholder="" ></textarea>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Keperluan</label>
			<select name="keperluan" class="form-control" placeholder="" onchange="lainnyabukan(this.value);">
				<option value="Penyidikan">Penyidikan</option>
				<option value="Pelacakan">Pelacakan</option>
				<option value="Pembuatan Konten">Pembuatan Konten</option>
				<option value="Dokumentasi">Dokumentasi</option>
				<option value="Lainnya">Lainnya</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-4 lainnya hidden">
		<div class="form-group">
			<label class="form-label">Lainnya</label>
			<input type="text" id="lainnya" name="lainnya" class="form-control" placeholder="" >
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
function macetgak(){
	var tv=$("#terdeteksi").val();
	if(tv=='Ada'){
		if($("#objek").val()=="Kendaraan"){
			$("#nama").val("");
			$("#jk").val("");
			$("#posisio").val("");
			$("#waktuo").val("");
			$(".orang").hide();
			$(".kendaraan").show();
		}else{
			$("#nopol").val("");
			$("#posisik").val("");
			$("#waktuk").val("");
			$(".kendaraan").hide();
			$(".orang").show();
		}
	}else{
		$("#nopol").val("");
		$("#posisik").val("");
		$("#waktuk").val("");
		$("#nama").val("");
		$("#jk").val("");
		$("#posisio").val("");
		$("#waktuo").val("");
		$(".kendaraan").hide();
		$(".orang").hide();
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