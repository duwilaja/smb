<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,";
$cols.="objek,kejadian,ket,pengunjung,kendaraan_in,kendaraan_out,kategori";
?>

<input type="hidden" name="tablename" value="tmc_cctv_public">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">

<div class="row">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Kategori</label>
			<select name="kategori" class="form-select select2" placeholder="" onchange="getSubQ('laporan/get_subqx',this.value,'#objek','','','lokasi','nama_lokasi as v,nama_lokasi as t','kategori_static');">
			<option value=""></option>
<?php for($i=0;$i<count($kategori);$i++){?>
<option value="<?php echo $kategori[$i]?>"><?php echo $kategori[$i]?></option>
<?php }?>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-6">
		<div class="form-group">
			<label class="form-label">Objek</label>
			<select id="objek" name="objek" class="form-select select2" placeholder="">
				<option value=""></option>
				<!--option value="Terminal">Terminal</option>
				<option value="Stasiun">Stasiun</option>
				<option value="Bandara">Bandara</option>
				<option value="Tempat Wisata">Tempat Wisata</option>
				<option value="Mall">Mall</option>
				<option value="Rest Area">Rest Area</option-->
			</select>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Jml Pengunjung</label>
			<input type="text" name="pengunjung" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Jml Kendaraan Masuk</label>
			<input type="text" name="kendaraan_in" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Jml Kendaraan Keluar</label>
			<input type="text" name="kendaraan_out" class="form-control" placeholder="" >
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Kejadian Terpantau</label>
			<select name="kejadian" class="form-select" placeholder="">
				<option value="Tidak Ada">Tidak Ada</option>
				<option value="Ada">Ada</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Keterangan</label>
			<textarea name="ket" class="form-control" placeholder="" ></textarea>
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
	
	$(".select2").select2();

	$(".<?php echo $frid?>").attr("disabled",true);
</script>