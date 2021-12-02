<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,";
$cols.="sim,pelanggaran,penindakan,tanggal,jml,usia";
?>

<input type="hidden" name="tablename" value="tar_data">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">

<div class="row">
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Tanggal</label>
			<input type="text" name="tanggal" class="form-control datepicker">
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Pelanggaran</label>
	<?php
//$pelanggaran['']='';
//$opt=array('class'=>'form-control','id'=>'penyebab','onchange'=>"getSubQ('laporan/get_subq',this.value,'#penyebabd','','','penyebab_macet_d','detil as v,detil as t','sebab');");
$opt=array('class'=>'form-control','id'=>'pelanggaran');
echo form_dropdown('pelanggaran', array_reverse($pelanggaran,true), '',$opt);
?>
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">SIM</label>
	<?php
$sim=array(
	"SIM A"=>"SIM A",
	"SIM B"=>"SIM B",
	"SIM C"=>"SIM C",
	"NON SIM"=>"NON SIM"
	);
$opt=array('class'=>'form-control','id'=>'sim');
echo form_dropdown('sim', array_reverse($sim,true), '',$opt);
?>
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Usia</label>
	<?php
$usia=array(
	"<18"=>"<18 th",
	"18-25"=>"18-25 th",
	"25-40"=>"25-40 th",
	">40"=>">40 th"
	);
$opt=array('class'=>'form-control','id'=>'usia');
echo form_dropdown('usia', array_reverse($usia,true), '',$opt);
?>
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Jumlah</label>
			<input type="text" name="jml" class="form-control">
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Penindakan</label>
			<input type="text" name="penindakan" class="form-control">
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
		},
		"penindakan" : {
			required : true,
			number : true
		},
		"jml" : {
			required : true,
			number : true
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