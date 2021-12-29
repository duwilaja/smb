<div class="card">
	<div class="card-header">
		<div class="card-title judul">
			<div class="row">
				<div class="col-6">
					<div class="form-group">
                        <label for="">Start Date</label>
						<input type="date" name='' class="form-control" id="start_tgl" value=''>
					</div>
				</div>
                <div class="col-6">
					<div class="form-group">
                        <label for="">End Date</label>
						<input type="date" name='' class="form-control" id="end_tgl" value=''>
					</div>
				</div>
                <!-- <div class="col-2" style="padding-top:2.7em">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div> -->
			</div>
		</div>
		<div class="card-options ">
			<!--a href="#" title="Batch" class=""><i class="fe fe-upload"></i></a>
			<a href="#" onclick="openForm(0);" data-toggle="modal" data-target="#myModal" title="Add" class=""><i class="fe fe-plus"></i></a-->
			<a href="#" title="Refresh" onclick="reload_table();"><i class="fe fe-refresh-cw"></i></a>
			<a href="#" title="Expand/Collapse" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
			<!--a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a-->
		</div>
	</div>
	<div class="card-body">
        <div class="row mb-4">
            <input type="hidden" id="nrp" value="<?= isset($session)?$session['nrp']:""?>">
            <div class="col-3">
                Nama : <br><?= isset($session)?$session['nama']:""?>
            </div>
            <div class="col-3">
                NRP : <br> <?= isset($session)?$session['nrp']:""?>
            </div>
            <div class="col-3">
                Jumlah Input : <br> <span id="jumlah_input"></span>
            </div>
            <div class="col-3">
                <label for="">Pilih History</label>
                <select id="opt_history" class="form-control">
                    <option value="" disabled>Pilih History</option>
                    <?php foreach ($history as $v) { ?>
                        <option value="<?= $v['v']?>"><?= $v['t']?></option>
                    <?php }?>
                </select>
            </div>
        </div>
		<div class="table-responsive">
			<table id="tbl_history" class="table table-striped table-bordered w-100">
                <thead id="htbl_history">
                </thead>
                <tbody>
                </tbody>
			</table>
		</div>
	</div>
</div>