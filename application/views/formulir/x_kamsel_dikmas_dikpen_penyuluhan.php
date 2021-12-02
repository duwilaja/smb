<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<input type="hidden" name="tablename" value="dikmas_dikpen_penyuluhan">
<input type="hidden" name="fieldnames" value="nrp,unit,polda,polres,dinas,subdinas,tgl,dasar,nomor,deskgiat,namagiat,tglgiat">

<div class="row">
	<div class="col-sm-6 col-md-2">
		<div class="form-group">
			<label class="form-label">Tgl Kegiatan</label>
			<input type="text" name="tglgiat" class="form-control datepicker" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-4">
		<div class="form-group">
			<label class="form-label">Nama Kegiatan</label>
			<input type="text" name="namagiat" class="form-control" placeholder="" >
		</div>
	</div>
	<div class="col-sm-6 col-md-6">
		<div class="form-group">
			<label class="form-label">Deskripsi Kegiatan</label>
			<textarea name="deskgiat" class="form-control" placeholder="" ></textarea>
		</div>
	</div>
</div>


<script>
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
		"tglgiat" : {
            required : true
        },
		"namagiat" : {
            required : true
        },
		"deskgiat" : {
			required : true
		}
    }});

$("#btn_save").show();
datepicker(true);
</script>