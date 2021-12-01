<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,";
$cols.="da,res,thn,jml,md,lb,lr,rumat,tanggal,jam,penyebab,lokasi,kendaraan";
?>

<input type="hidden" name="tablename" value="ais_laka">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">

<?php
if($session['polda']!=''){ //non pusat use default
   echo '<input type="hidden" name="da" value="'.$session['polda'].'" />';
   echo '<input type="hidden" name="res" value="'.$session['polres'].'" />';
   echo '<input type="hidden" name="thn" value="'.date('Y').'" />';
   echo '<input type="hidden" name="jml" value="1" />';
}else{
?>
<div class="row">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Polda</label>
		<?php
$polda['']='';
//print_r(array_reverse($polda,true));
$opt=array('class'=>'form-control','id'=>'da','onchange'=>"getSubQ('profile/get_polres',this.value,'#res');");
echo form_dropdown('da', array_reverse($polda,true), '',$opt);
	?>
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Polres</label>
			<select name="res" id="res" class="form-control">
				<option value=""></option>
			</select>
		</div>
	</div>
</div>
<?php } //end non pusat?>
<div class="row">
<?php
if($session['polda']==''){ //pusat free choice
?>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Tahun</label>
			<input type="text" name="thn" class="form-control yearpicker">
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Kejadian</label>
			<input type="text" name="jml" class="form-control">
		</div>
	</div>
<?php }else{?>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Tanggal</label>
			<input type="text" name="tanggal" class="form-control datepicker">
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Jam</label>
			<input type="text" name="jam" class="form-control timepicker">
		</div>
	</div>
<?php }?>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Meninggal</label>
			<input type="text" name="md" class="form-control">
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Luka Berat</label>
			<input type="text" name="lb" class="form-control">
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Luka Ringan</label>
			<input type="text" name="lr" class="form-control">
		</div>
	</div>
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Kerugian Materi</label>
			<input type="text" name="rumat" class="form-control">
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Penyebab</label>
	<?php
$penyebab['']='';
//$opt=array('class'=>'form-control','id'=>'penyebab','onchange'=>"getSubQ('laporan/get_subq',this.value,'#penyebabd','','','penyebab_macet_d','detil as v,detil as t','sebab');");
$opt=array('class'=>'form-control','id'=>'penyebab');
echo form_dropdown('penyebab', array_reverse($penyebab,true), '',$opt);
?>
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Lokasi</label>
			<input type="text" name="lokasi" class="form-control">
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Kendaraan</label>
	<?php
$kendaraan=array(
	"TAKSI"=>"TAKSI",
	"BUS SEKOLAH"=>"BUS SEKOLAH",
	"BUS PARIWISATA"=>"BUS PARIWISATA",
	"RENTAL"=>"RENTAL",
	"OJEK"=>"OJEK",
	"ANGKOT"=>"ANGKOT",
	"ANGKUTAN BARANG"=>"ANGKUTAN BARANG",
	"PRIBADI"=>"PRIBADI"
	);
$opt=array('class'=>'form-control','id'=>'kendaraan');
echo form_dropdown('kendaraan', array_reverse($kendaraan,true), '',$opt);
?>
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
		"media" : {
			required : true
		},
		"jenis" : {
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