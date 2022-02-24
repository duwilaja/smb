<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$cols="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,";
$cols.="media,jenis,isi,link";
?>

<input type="hidden" name="tablename" value="tmc_publikasi">
<input type="hidden" name="fieldnames" value="<?php echo $cols?>">

<div class="row">
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Media</label>
			<select name="media" class="form-select" placeholder="">
<?php for($i=0;$i<count($media);$i++){?>
<option value="<?php echo $media[$i]['val']?>"><?php echo $media[$i]['txt']?></option>
<?php }?>
				<!--option value="Facebook">Facebook</option>
				<option value="Tweeter">Tweeter</option>
				<option value="Website">Website</option>
				<option value="Center">Center</option-->
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Jenis</label>
			<select name="jenis" class="form-select" placeholder="">
				<option value="SIMLing">SIMLing</option>
				<option value="SAMLing">SAMLing</option>
				<option value="TAEW">TAEW</option>
				<option value="Himbauan Kamseltibcar">Himbauan Kamseltibcar</option>
			</select>
		</div>
	</div>
	<div class="col-sm-6 col-md-12">
		<div class="form-group">
			<label class="form-label">Isi</label>
			<textarea name="isi" class="form-control"></textarea>
		</div>
	</div>
	<div class="col-sm-6 col-md-12">
		<div class="form-group">
			<label class="form-label">Link</label>
			<input type="text" name="link" class="form-control">
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
		},
		"link" : {
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

</script>