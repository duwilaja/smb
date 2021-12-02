<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
	<div class="col-lg-12">
		<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
		Hi <?php echo $session['nama']?> @ <?php echo $session['unit']?>, silakan pilih formulir laporan anda</div>
	</div>
</div>

<!-- Row -->
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Form Kegiatan <?php echo $session['unit']?> (<?php echo date("D, d M Y")?>)</h3>
				<div class="card-options ">
					<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
					<!--a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a-->
				</div>
			</div>
			<div class="card-body"><form name="myf" id="myf">
			
			<div class="row"><div class="col-lg-12">
				<div class="btn-list">
					<?php 
					$keys=array_keys($formulir);
					$values=array_values($formulir);
					for($i=0;$i<count($formulir);$i++){
					?>
					<button type="button" class="btn btn-twitter btn-pill <?php echo $keys[$i]?>" onclick="ambil_isi('<?php echo $keys[$i]?>');"><i class="fa fa-list-alt"></i> <?php echo $values[$i]?></button>
					<?php } ?>
				</div>
			</div></div>
			
<!--hidden-->
<input type="hidden" name="rowid" id="rowid" value="0" />
<input type="hidden" name="nrp" value="<?php echo $session['nrp']?>">
<input type="hidden" name="polda" value="<?php echo $session['polda']?>">
<input type="hidden" name="polres" value="<?php echo $session['polres']?>">
<input type="hidden" name="dinas" value="<?php echo $session['dinas']?>">
<input type="hidden" name="subdinas" value="<?php echo $session['subdinas']?>">
<input type="hidden" name="unit" value="<?php echo $session['unit']?>">
<input type="hidden" name="tgl" value="<?php echo date('Y-m-d')?>">

				<!--div class="row">
					<div class="col-sm-6 col-md-4 hidden">
						<div class="form-group">
							<label class="form-label">Formulir</label>
<?php
$formulir['']='---pilih formulir---';
$opt=array('class'=>'form-control','id'=>'formulir','onchange'=>"ambil_isi(this.value);");
echo form_dropdown('formulir', array_reverse($formulir,true), '',$opt);
?>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 dasar">
						<div class="form-group">
							<label class="form-label">Dasar</label>
							<?php
							$dasargiat['']='---pilih dasar giat---';
							$opt=array('class'=>'form-control','id'=>'dasar');
							echo form_dropdown('dasar', array_reverse($dasargiat,true), '',$opt);
							?>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 nomor">
						<div class="form-group">
							<label class="form-label">Nomor</label>
							<input type="text" id="nomor" name="nomor" class="form-control" placeholder="" >
						</div>
					</div>					
				</div-->
				<hr />
				<div class="dimmer active ldr hidden">
					<div class="sk-cube-grid">
						<div class="sk-cube sk-cube1"></div>
						<div class="sk-cube sk-cube2"></div>
						<div class="sk-cube sk-cube3"></div>
						<div class="sk-cube sk-cube4"></div>
						<div class="sk-cube sk-cube5"></div>
						<div class="sk-cube sk-cube6"></div>
						<div class="sk-cube sk-cube7"></div>
						<div class="sk-cube sk-cube8"></div>
						<div class="sk-cube sk-cube9"></div>
					</div>
				</div>
				<div id="isilaporan"></div>
			</form></div>
			<div class="card-footer text-right">
				<button type="button" id="btn_save" class="btn btn-primary hidden" onclick="simpanlah();">Simpan Laporan</button>
			</div>
		</div>
	</div>
</div>
<!-- End Row-->

<script>
var jvalidate=null;

function simpanlah(){
	if(typeof(safeform)=="function"){
		safeform('#myf'); //sendData to the specific controller/function
	}else{
		sendData('#myf','laporan/save');
	}
}
function ambil_isi(v){
	safeform=null;
	
	$(".btn-pill").attr("disabled",false);
	reset_isi();
	if(v==''){
		alrt("Please select a value for formulir","error");
		return;
	}
	$("."+v).attr("disabled",true);
	$("#formulir").val(v);
	get_content('laporan/get_content',{id:v},'.ldr','#isilaporan');
}
function reset_isi(){
	jvalidate=null;
	$("#isilaporan").html('');
	$("#btn_save").hide();
	$(".nomor").hide();
	$(".dasar").hide();
	$(".is-invalid").removeClass("is-invalid");
	$(".is-valid").removeClass("is-valid");
}

function thispage_ready(){
	reset_isi();
}
</script>
