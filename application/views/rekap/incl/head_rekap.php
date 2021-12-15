<div class="card">
	<div class="card-header">
	    <div class="row">
	        <div class="col-md-8">
	            <h5 class="titel_rekap">-</h5>
	            <span>Hasil Rekapitulasi Data
	            </span>
	        </div>

	        <div class="col-md-4">
	            <div id="pilih_rekap"></div>
	        </div>
	    </div>
	</div>
	<div class="card-body" style="padding-top:20px;">
		<div class="filter">
			<div class="row">
				<div class="col-md-3">
					<div class="mb-1">Tanggal</div>
					<input type="text" placeholder="Filter Tanggal" class="form-control datepicker" id="tgl">
				</div>
                <div class="col-md-3">
                    <a href="#" title="Refresh" style="position: absolute;left:0;bottom:0;" class="btn btn-success" onclick="reload_table();"><i class="fe fe-refresh-cw"></i> Filter</a>
                </div>
			</div>
		</div>