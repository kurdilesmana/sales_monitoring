<div class="row">
	<div class="col-md-6">
		<!-- AREA CHART -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Sales Quantity</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body">
				<div class="chart">
					<canvas id="areaChart" style="height:270px"></canvas>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
		
		<?= $this->session->userdata('user_brand'); ?>
		<?= $this->session->userdata('user_divisi'); ?>

		<!-- AREA CHART -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Sales Omset</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body">
				<div class="chart">
					<canvas id="areaChartOmset" style="height:270px"></canvas>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col (LEFT) -->
	<div class="col-md-6">
		<!-- DONUT CHART -->
		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 class="box-title">Area Quantity</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body">
				<canvas id="pieChart" style="height:300px"></canvas>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
		<!-- DONUT CHART -->
		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 class="box-title">Area Omset</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body">
				<canvas id="pieChartOmset" style="height:250px"></canvas>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col (RIGHT) -->
</div>
<!-- /.row -->