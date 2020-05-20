
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
					Statistik Pemasukan Kas
						
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
						<div class="panel-body">
							<canvas id="chart_data_pemilik_polis" class="main-chart" height="150" width="600"></canvas>
							<script type="text/javascript" src="<?php echo base_url('asset/Chart.js')?>" ></script>
							<?php
							$host       = "localhost";
							$user       = "root";
							$password   = "";
							$database   = "proyek2";
							$koneksi    = mysqli_connect($host, $user, $password, $database);
							//
							$label = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
							for($bulan = 1;$bulan < 13;$bulan++)
							{
								$idOrganisasi	= $this->session->userdata('idOrganisasi');
								$query = mysqli_query($koneksi,"select sum(pemasukan_kas) as jumlah from kas where MONTH(tanggal)='$bulan' && idOrganisasi ='$idOrganisasi'");
								$row = $query->fetch_array();
								$jumlah_pemilik[] = $row['jumlah'];
							}

							?>
							<script>
								var chart2 = document.getElementById("chart_data_pemilik_polis").getContext('2d');
								var myChart = new Chart(chart2, {
									type: 'bar',
									data: {
										labels: <?php echo json_encode($label); ?>,
										datasets: [{
											label: 'Jumlah Pemasukan Kas',
											data: <?php echo json_encode($jumlah_pemilik); ?>
											,
											backgroundColor: ['rgb(99, 195, 255)', 'rgba(99, 167, 255)', 'rgb(99, 122, 255)','rgb(102, 99, 255)','rgb(99, 206, 255)','rgb(99, 167, 255)','rgb(99, 182, 255)','rgb(99, 172, 255)','rgb(99, 143, 255)','rgb(99, 130, 255)','rgb(99, 112, 255)','rgb(999, 203, 255)'],
											borderWidth: 1
										}]
									},
									options: {
										scales: {
											yAxes: [{
												ticks: {
													beginAtZero:true
												}
											}]
										}
									}
								});
							</script>
						</div>
				    </div>
				</div>
				</div>
			</div>
		</div>
		<!--/.row-->
    </div>
</div>
<hr>	
<br/>		
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
					Statistik Pengeluaran Kas
						
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
						<div class="panel-body">
							<canvas id="chart_data_pemilik_polis2" class="main-chart" height="150" width="600"></canvas>
							<script type="text/javascript" src="<?php echo base_url('asset/Chart.js')?>" ></script>
							<?php
							$host       = "localhost";
							$user       = "root";
							$password   = "";
							$database   = "proyek2";
							$koneksi    = mysqli_connect($host, $user, $password, $database);
							//
							$label2 = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
							for($bulan2 = 1;$bulan2 < 13;$bulan2++)
							{
								$idOrganisasi	= $this->session->userdata('idOrganisasi');
								$query = mysqli_query($koneksi,"select sum(pengeluaran_kas) as jumlah2 from kas where MONTH(tanggal)='$bulan2' && idOrganisasi = '$idOrganisasi'");
								$row = $query->fetch_array();
								$jumlah_pemilik2[] = $row['jumlah2'];
							}

							?>
							<script>
								var chart2 = document.getElementById("chart_data_pemilik_polis2").getContext('2d');
								var myChart = new Chart(chart2, {
									type: 'bar',
									data: {
										labels: <?php echo json_encode($label2); ?>,
										datasets: [{
											label: 'Jumlah Pengeluaran Kas',
											data: <?php echo json_encode($jumlah_pemilik2); ?>
											,
											backgroundColor: ['rgb(255, 112, 99)', 'rgba(255, 125, 99)', 'rgb(255, 138, 99)','rgb(255, 151, 99)','rgb(255, 161, 99)','rgb(255, 167, 99)','rgb(255, 177, 99)','rgb(255, 198, 99)','rgb(255, 216, 99)','rgb(255, 224, 99)','rgb(255, 232, 99)','rgb(255, 245, 99)'],
											borderWidth: 1
										}]
									},
									options: {
										scales: {
											yAxes: [{
												ticks: {
													beginAtZero:true
												}
											}]
										}
									}
								});
							</script>
						</div>
				    </div>
				</div>
				</div>
			</div>
		</div>
		<!--/.row-->
    </div>
</div>