<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,";
$cols.="saluran,sumber,jam,jalan,lat,lng,jenis,dampak,uploadedfile,pelapor,telp,lainnya";
?>

<input type="hidden" name="tablename" value="tmc_pservice_gangguan">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">
<input type="hidden" name="kategori" value="gangguan">

<div class="row mb-2">
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Saluran Informasi</label>
			<select name="saluran" class="form-select" placeholder="">
				<option value="Call Center">Call Center</option>
				<option value="Email">Email</option>
				<option value="Medsos">Medsos</option>
				<option value="Mobile Apps">Mobile Apps</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Sumber Informasi</label>
			<select name="sumber" class="form-select" placeholder="">
				<option value="Individu">Individu</option>
				<option value="Kelompok Masyarakat">Kelompok Masyarakat</option>
				<option value="Instansi Pemerintah">Instansi Pemerintah</option>
				<option value="Instansi Swasta">Instansi Swasta</option>
				<option value="Akademisi">Akademisi</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Nama</label>
			<input type="text" name="pelapor" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Telp./CP</label>
			<input type="text" name="telp" class="form-control" placeholder="" >
		</div>
	</div>
	
</div>
<div class="row mb-2">
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Jam</label>
			<input type="text" name="jam" class="form-control timepicker" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Lokasi/Jalan</label>
			<input type="text" name="jalan" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Latitude</label>
			<input type="text" id="lat" name="lat" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Longitude</label>
			<input type="text" id="lng" name="lng" class="form-control mb-1" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-1">
		<div class="form-group">
			<label class="form-label">&nbsp;</label>
			<button type="button" class="btn btn-danger" onclick="mappicker('#lat','#lng');"><i class="fa fa-map-marker"></i></button>
		</div>
	</div>
</div>
<div class="row mb-2">
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Jenis Gangguan</label>
			<select name="jenis" class="form-select" placeholder="" onclick="lainnyabukan(this.value);">
				<option value="Banjir">Banjir</option>
				<option value="Tanah Longsor">Tanah Longsor</option>
				<option value="Pohon Tumbang">Pohon Tumbang</option>
				<option value="Unjuk Rasa">Unjuk Rasa</option>
				<option value="Konser">Konser</option>
				<option value="Pameran">Pameran</option>
				<option value="Festival">Festival</option>
				<option value="Olahraga">Olahraga</option>
				<option value="Kegiatan Keagamaan">Kegiatan Keagamaan</option>
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
	<div class="col-sm-6 col-md-3">
		<div class="form-group">
			<label class="form-label">Bisa Berdampak</label>
			<select name="dampak" class="form-select" placeholder="">
				<option value="Kemacetan">Kemacetan</option>
				<option value="Kecelakaan">Kecelakaan</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-5">
		<div class="form-group files">
			<label class="form-label">Foto/Video</label>
			<input type="file" name="uploadedfile[]" class="form-control file" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-1">
		<label class="form-label">&nbsp;</label>
		<button type="button" class="btn btn-danger" onclick="$('.files').append($('.file').clone().removeClass('file'));"><i class="fa fa-copy"></i></button>
	</div>
</div>


<script>
function mappicker(lat,lng){
	window.open(base_url+"map?lat="+$(lat).val()+"&lng="+$(lng).val(),"MapWindow","width=830,height=500,location=no").focus();
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
		"tempat" : {
			required : true
		},
		"tanggal" : {
			required : true
		}
    }});

$("#btn_save").show();
$(".dasar").show();
$(".nomor").show();

datepicker(true);
timepicker();
$(".select2").select2();

$(".is-invalid").removeClass("is-invalid");
$(".is-valid").removeClass("is-valid");

function safeform(thef){
	sendData('#myf','PublicService/save');
}
function lainnyabukan(tv){
	if(tv=='Lainnya'){
		$(".lainnya").show();
	}else{
		$("#lainnya").val("");
		$(".lainnya").hide();
	}
}
</script>