	<form action="<?= base_url() ?>index.php/Ormawa/simpan_ormawa" method="POST" enctype="multipart/form-data">
	<table>
	<tr>
		<td>Nama Organisasi</td>
		<td><input type="text" name="namaOrganisasi"></td>
	</tr>
	<tr>
		<td>Deskripsi</td> 
		<td><textarea name="deskripsi" cols="40" rows="10"></textarea></td>
	</tr>
	<tr>
		<td>Logo</td>
		<td><input type="file" name="logo"></td>
	</tr>
	<tr>
		<td>Ketua Organisasi</td>
		<td><input type="text" name="ketua"></td>
	</tr>
	<tr>
		<td align="center">
			<input type="submit" name="submit" value="Buat">
		</td>
	</tr>	
	</table>