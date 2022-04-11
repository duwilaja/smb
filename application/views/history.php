<div class="card">
	<div class="card-header">
		<div class="card-title judul">
        <?php if(!isset($unit)){?>
        <input type="hidden" id="nrp" value="<?= isset($session)?$session['nrp']:""?>">
		<input type="hidden" id="unit" value="<?= isset($session)?$session['unit']:""?>">
		<?php }?>
            <form action="javascript:void();" id="form-filter">
		<?php if(isset($unit)){?>
			<div class="row">
				<div class="col-4">
					<div class="form-group">
						<label for="">Divisi</label>
						<select id="unit" class="form-control" onchange="getSubQ('laporan/get_subq',this.value,'#nrp','','','persons','nrp as v,nama as t','unit');">
							<option value=""></option>
							<?php foreach($unit as $u){?>
							<option value="<?php echo $u['unit_id']?>"><?php echo $u['unit_nam']?></option>
							<?php }?>
						</select>
					</div>
				</div>
				<div class="col-5">
					<div class="form-group">
						<label for="">Anggota</label>
						<select id="nrp" class="form-control">
						</select>
					</div>
				</div>
			</div>
		<?php }?>
			<div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Start Date</label>
                            <input type="date" name='' class="form-control" id="start_tgl" value=''>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">End Date</label>
                            <input type="date" name='' class="form-control" id="end_tgl" value=''>
                        </div>
                    </div>
                    <div class="col-1" style="padding-top:2.7em">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
		</div>
	</div>
	<div class="card-body">
        <div class="table-responsive">
            <table id="tbl_history" class="table table-striped table-bordered w-100">
                <thead>
                    <tr>
                        <th>Nrp</th>
                        <th>Divisi</th>
                        <th>Form</th>
                        <th>Jumlah Input</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
	</div>
</div>
