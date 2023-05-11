<?php
include 'koneksi.php';

include 'header_user.php';
?>

<style >
	.btn{
		margin-bottom: 10px;
	}

</style>
<div class="container">
	<div class="page-header">
<h2> DATA WALIKELAS SMK NEGERI 3 KENDAL</h2>
	</div>
<table class="table table-bordered table-striped" >
<tr>
	<th>NO</th>
	<th>KELAS</th>
	<th>NAMA GURU</th>
</tr>
<?php
	$data = $konek -> query("SELECT walikelas.kelas, walikelas.idguru,guru.namaguru FROM walikelas INNER JOIN guru ON walikelas.idguru=guru.idguru ORDER BY walikelas.kelas ASC ");

	$i = 1;
	while($dta = mysqli_fetch_assoc($data)) :
	?>
	<tr>
		<td width="40" align="center"><?=$i;?></td>
		<td align="center"><?= $dta['kelas'] ?></td>
		<td><?= $dta['namaguru'] ?></td>
	</tr>
	<?php $i++ ; ?>
<?php endwhile; ?>
</table>
</div>
<?php include 'footer.php';  ?>