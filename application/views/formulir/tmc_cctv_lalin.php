<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,";
$cols.="situasi,kejadian,jalan,status,mulai,sampai,sebab,petugas,callsign";
?>

<input type="hidden" name="tablename" value="tmc_cctv_lalin">
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
			<label class="form-label">Situasi Lalin</label>
			<select name="situasi" class="form-control" placeholder="" onchange="macetgak(this.value);">
				<option value="Lancar">Lancar</option>
				<option value="Padat">Padat</option>
				<option value="Macet">Macet</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Kejadian Terpantau</label>
			<select id="kejadian" name="kejadian" class="form-control" placeholder="">
				<option value=""></option>
				<option value="Kemacetan">Kemacetan</option>
				<option value="Demo">Demo</option>
				<option value="Laka">Laka</option>
				<option value="Langgar">Langgar</option>
				<option value="TindakPidana">Tindak Pidana</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Lokasi</label>
			<input type="text" name="jalan" class="form-control" placeholder="" >
		</div>
	</div>
</div>
<div class="row macet">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Status Penggal Jalan</label>
			<select name="status" id="penggal" class="form-control" placeholder="">
				<option value=""></option>
				<option value="Rawan Bencana">Rawan Bencana</option>
				<option value="Black Spot">Black Spot</option>
				<option value="Trouble Spot">Trouble Spot</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Jam Mulai</label>
			<input type="text" id="mulai" name="mulai" class="form-control timepicker" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Sampai</label>
			<input type="text" id="sampai" name="sampai" class="form-control timepicker" placeholder="" >
		</div>
	</div>
</div>
<div class="row macet">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Penyebab</label>
	<?php
$penyebab['']='';
$opt=array('class'=>'form-control','id'=>'sebab');
echo form_dropdown('sebab', array_reverse($penyebab,true), '',$opt);
?>
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Petugas Lapangan</label>
			<input type="text" id="petugas" name="petugas" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">CallSign</label>
			<input type="text" id="callsign" name="callsign" class="form-control" placeholder="" >
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
		$("#kejadian").val("Kemacetan");
	}else{
		$("#sebab").val("");
		$("#penggal").val("");
		$("#callsign").val("");
		$("#mulai").val("");
		$("#sampai").val("");
		$("#petugas").val("");
		$("#kejadian").val("");
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