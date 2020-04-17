<center><h1>Laporan Kas</h1></center>
<hr>
<hr>
<table>
<?php 
  session_start();
?>
	<?php foreach ($total_laporan1 as $key) { ?>
	
		<tr style="background-color: #E0FFFF;">
			<th>Total Pemasukan</th> 
            <td width="100">(+)</td>
            <td><b> Rp <?php echo number_format($key->total_masuk) ?></b></td>
            
        </tr>
        <tr style="background-color: #FFB6C1;">
            <th>Total Pengeluaran</th>
            <td width="100">(-)</td>
            <td><b> Rp <?php echo number_format($key->total_keluar) ?></b></td>
        </tr>
</table>

            ----------------------------------------------------------------------------------
<table>
         <tr style="background-color: #98FB98;">
            <th>Total Kas</th>
            <td width="170"></td>
            <td><b> Rp <?php echo $key->total_kas ?></b></td>
		</tr>	
 </table> <br>

 
<?php } ?>