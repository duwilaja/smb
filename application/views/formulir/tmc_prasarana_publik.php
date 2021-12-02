<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,";
$cols.="prasarana,nama,k_datang,k_berangkat,p_datang,p_berangkat,parkir,k_diangkut,r2_gowes,r2_motor,r4,r6,pengunjung,k_kendaraan";
?>

<input type="hidden" name="tablename" value="tmc_prasarana_publik">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">

<div class="row">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Prasarana</label>
			<select name="prasarana" class="form-control" placeholder="" onchange="prasaranachanged(this.value)">
				<option value=""></option>
				<option value="Terminal">Terminal</option>
				<option value="Pelabuhan">Pelabuhan</option>
				<option value="Bandara">Bandara</option>
				<option value="Stasiun">Stasiun</option>
				<option value="Tempat Wisata">Tempat Wisata</option>
				<option value="Gerbang Tol">Gerbang Tol</option>
				<option value="Gedung">Gedung</option>
				<option value="Pusat Perbelanjaan">Pusat Perbelanjaan</option>
				<option value="Sarana Olahraga">Sarana Olahraga</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-6">
		<div class="form-group">
			<label class="form-label">Nama</label>
			<input type="text" name="nama" class="form-control myfld" />
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-3 terminal pelabuhan bandara stasiun tol semua">
		<div class="form-group">
			<label class="form-label">Kedatangan</label>
			<input type="text" name="k_datang" class="form-control myfld" />
		</div>
	</div>
	<div class="col-sm-6 col-md-3 terminal pelabuhan bandara stasiun tol semua">
		<div class="form-group">
			<label class="form-label">Keberangkatan</label>
			<input type="text" name="k_berangkat" class="form-control myfld" />
		</div>
	</div>
	<div class="col-sm-6 col-md-3 terminal pelabuhan bandara stasiun semua">
		<div class="form-group">
			<label class="form-label">Penumpang Datang</label>
			<input type="text" name="p_datang" class="form-control myfld" />
		</div>
	</div>
	<div class="col-sm-6 col-md-3 terminal pelabuhan bandara stasiun semua">
		<div class="form-group">
			<label class="form-label">Penumpang Berangkat</label>
			<input type="text" name="p_berangkat" class="form-control myfld" />
		</div>
	</div>
	<div class="col-sm-6 col-md-3 pelabuhan stasiun semua">
		<div class="form-group">
			<label class="form-label">Kendaraan Diangkut</label>
			<input type="text" name="k_diangkut" class="form-control myfld" />
		</div>
	</div>
	<div class="col-sm-6 col-md-3 wisata semua">
		<div class="form-group">
			<label class="form-label">R2 Gowes</label>
			<input type="text" name="r2_gowes" class="form-control myfld" />
		</div>
	</div>
	<div class="col-sm-6 col-md-3 wisata semua">
		<div class="form-group">
			<label class="form-label">R2 Motor</label>
			<input type="text" name="r2_motor" class="form-control myfld" />
		</div>
	</div>
	<div class="col-sm-6 col-md-3 wisata semua">
		<div class="form-group">
			<label class="form-label">R4</label>
			<input type="text" name="r4" class="form-control myfld" />
		</div>
	</div>
	<div class="col-sm-6 col-md-3 wisata semua">
		<div class="form-group">
			<label class="form-label">R6</label>
			<input type="text" name="r6" class="form-control myfld" />
		</div>
	</div>
	<div class="col-sm-6 col-md-3 wisata gedung belanja olahraga semua">
		<div class="form-group">
			<label class="form-label">Jml. Pengunjung</label>
			<input type="text" name="pengunjung" class="form-control myfld" />
		</div>
	</div>
	<div class="col-sm-6 col-md-3 tol semua">
		<div class="form-group">
			<label class="form-label">Klasifikasi Kendaraan</label>
			<input type="text" name="k_kendaraan" class="form-control myfld" />
		</div>
	</div>
	<div class="col-sm-6 col-md-3 terminal pelabuhan bandara stasiun tol wisata gedung belanja olahraga semua">
		<div class="form-group">
			<label class="form-label">Kapasitas Parkir</label>
			<input type="text" name="parkir" class="form-control myfld" />
		</div>
	</div>
	
</div>

<script>
function prasaranachanged(tv){
	$(".semua").hide();
	$(".myfld").val("");
	switch(tv){
		case "Terminal": $(".terminal").show(); break;
		case "Pelabuhan": $(".pelabuhan").show(); break;
		case "Bandara": $(".bandara").show(); break;
		case "Stasiun": $(".stasiun").show(); break;
		case "Tempat Wisata": $(".wisata").show(); break;
		case "Gerbang Tol": $(".tol").show(); break;
		case "Gedung": $(".gedung").show(); break;
		case "Pusat Perbelanjaan": $(".belanja").show(); break;
		case "Sarana Olahraga": $(".olahraga").show(); break;
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
		"prasarana" : {
			required : true
		},
		"nama" : {
			required : true
		}
    }});

$("#btn_save").show();
$(".dasar").show();
$(".nomor").show();

datepicker(true);
timepicker();

$(".is-invalid").removeClass("is-invalid");
$(".is-valid").removeClass("is-valid");

prasaranachanged('');
</script>