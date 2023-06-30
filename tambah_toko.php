<?php

include_once("koneksi.php");

$kode_toko = "";
$nama_toko = "";
$pesan_error = array();

	// Check If form submitted, insert form data into users table.
if(isset($_POST["submit"])) {
	$kode_toko = htmlentities(strip_tags(trim($_POST['kode_toko'])));
	$nama_toko = htmlentities(strip_tags(trim($_POST['nama_toko'])));

	$pesan_error = array();

	if ($kode_toko === "Kode toko") {
		$pesan_error[]= "Bulan belum dipilih!";
	}

	if ($nama_toko === "Nama toko") {
		$pesan_error[]= "Tahun belum dipilih!"; 
	}


	$bln_thn = $bulan." ".$tahun;


	if (!$pesan_error) {
		$kode_toko = mysqli_real_escape_string($koneksi,$kode_toko);
		$nama_toko = mysqli_real_escape_string($koneksi,$nama_toko);

		$querytambah = "INSERT INTO tb_daftar_toko(kode_toko,nama_toko) ";
		$querytambah .= "VALUES('$kode_toko','$nama_toko')";

		$resultquery = mysqli_query($koneksi,$querytambah);

		if ($resultquery) {
			$pesan_sukses = "Data toko \"<b>$kode_toko</b>\" berhasil ditambahkan!";
			$pesan_sukses = urlencode($pesan_sukses);
			header("Location: data_toko.php?pesan_sukses={$pesan_sukses}");
		}
		else {
			die("Query gagal dijalankan: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
		}
		mysqli_free_result($resultquery);
		mysqli_close($koneksi);
	}
}

?>

<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="UTF-8">
	<title>Tambah Data Penjualan - SB Group</title>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/style.css">

</head>
<body>
	<!-- partial:index.partial.html -->
	<?php
	include_once 'sidebar.php';
	?>

	<div class="content-container">

		<div class="container-fluid">

			<!-- Main component for a primary marketing message or call to action -->
			<div class="jumbotron">
				<h2 style="margin-bottom: 25px;">Tambah Data Penjualan</h2>
				<?php
				if ($pesan_error !=="") {
					foreach ($pesan_error as $per) {
						echo "<div class='alert alert-danger alert-dismissible'>
						<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<strong>Gagal!</strong> ".$per.
						"</div>";
					}
				}
				?>
				<form action="tambah_toko.php" method="post" name="form1">
					<div class="row">
					<div class="form-group col">
						<label for="kode)toko">Kode Toko</label>
						<select name="kode_toko" class="form-control">
							<option selected="selected">Bulan</option>
							<?php
							$kode_toko=array("1","2","3","4","5","6","7","8","9","10");
							$jlh_bln=count($kode_toko);
							for($c=0; $c<$jlh_bln; $c+=1){
								echo"<option value=$kode_toko[$c]> $kode_toko[$c] </option>";
							}
							?>
						</select>
					</div>
					
			
					<div style="display: flex;">
						<div style="margin-top:20px;">
							<input class="btn btn-primary" type="submit" name="submit" value="Simpan">
						</div>
						<div style="margin: 20px 0px 0px 20px;">
							<a class="btn btn-danger" href="data_toko.php">Batal</a>
						</div>
					</div>
				</form>
			</div>

		</div>
	</div>
	<!-- partial -->
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
</body>
</html>