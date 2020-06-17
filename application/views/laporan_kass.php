&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
setlocale(LC_ALL, 'id-ID', 'id_ID');
echo strftime("%A, %d %B %Y");
// Hasil: Selasa, 04 April 2020
?>
<h1 style="background-color: #98FB98"> Laporan Kas </h1>
<table>
	<?php foreach ($total_laporan1 as $key) { ?>
	
		<tr style="background-color: #E0FFFF;">
			<th>Total Pemasukan</th> 
            <td width="100">(+)</td>
            <td><b> Rp <?php echo number_format($key->total_masuk,0,',','.') ?></b></td>
            
        </tr>
        <tr style="background-color: #FFB6C1;">
            <th>Total Pengeluaran</th>
            <td width="100">(-)</td>
            <td><b> Rp <?php echo number_format($key->total_keluar,0,',','.') ?></b></td>
        </tr>
</table>

            ----------------------------------------------------------------------------------
<table>
         <tr style="background-color: #98FB98;">
            <th>Total Kas</th>
            <td width="170"></td>
            <td><b> Rp <?php echo number_format($key->total_kas,0,',','.') ?></b></td>
		</tr>	
 </table> <br><br>
 <hr>
<?php } ?>
<h2> Pemasukan Kas </h2>
<table border="1" id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0">
        <tr style="background-color: #E0FFFF">
            <th>No</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Pemasukan Kas</th>
        </tr>
        <?php
            $i=1;
            foreach ($pemasukan as $data1) {
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $data1->tanggal; ?></td>
            <td><?php echo $data1->keterangan; ?></td>
            <td>Rp <?php echo number_format($data1->pemasukan_kas,0,',','.') ?></td>
        </tr>
        <?php $i++; }?>
    </table>
<h2> Pengeluaran Kas </h2>
<table border="1" id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0">
        <tr style="background-color: #FFB6C1">
            <th>No</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Pengeluaran Kas</th>
        </tr>
        <?php
            $i=1;
            foreach ($pengeluaran as $data) {
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $data->tanggal; ?></td>
            <td><?php echo $data->keterangan; ?></td>
            <td>Rp <?php echo number_format($data->pengeluaran_kas,0,',','.') ?></td>
        </tr>
        <?php $i++; }?>
    </table>

