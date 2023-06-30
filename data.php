<?php

session_start();

if (!isset($_SESSION["username"])) {
	header("Location: login.php");
}

include_once("koneksi.php");

$querytampil = "Select * from tb_penjualan";

if (isset($_GET['pesan_sukses'])) {
	$pesan_sukses = $_GET['pesan_sukses'];
}
?>

<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="UTF-8">
	<title>Data Penjualan - SB Group</title>
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
				<h2 style="margin-bottom: 25px;">Data Penjualan</h2>
				<?php
				if (isset($pesan_sukses)) {
					echo "<div class='alert alert-success alert-dismissible'>
					<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<strong>Berhasil!</strong> ".$pesan_sukses.
					"</div>";
				}	
				?>
				 <div class="container">
					<form method="POST">
						<div class="form-group">
							<label for="dropdown">Pilih Toko:</label>
							<select class="form-control" id="dropdown" name="dropdown" style="width:200px;">
								<option value="1">1. Modi</option>
								<option value="2">2. Zaskia</option>
								<option value="3">3. Fatih Market</option>
								<option value="1">4. Kardana</option>
								<option value="2">5. Mama Market</option>
								<option value="3">6. Market PIM</option>
								<option value="1">7. Mustika Toko</option>
								<option value="2">8. Rafa Jaya</option>
								<option value="3">9. Rayon Baru Toko</option>
							</select>
							<div class="form-group">
							<label for="dropdown">Pilih nama roti</label>
							<select class="form-control" id="dropdown" name="dropdown" style="width:200px;">
								<option value="1">Sandwich Cokklat II</option>
								<option value="2">Opsi 2</option>
								<option value="3">Opsi 3</option>
							</select>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
				<br>
				<br>

				<div style="margin-bottom: 10px;">
					<a class="btn btn-primary" href="tambah.php">Tambah Data</a>
				</div>
				<table class="table table-hover table-bordered">
					<tr>
						<th>Bulan - Tahun</th>
						<th>Data Aktual</th>
						<th colspan="2">Action</th>
					</tr>
					<?php
					$resultquery = mysqli_query($koneksi,$querytampil);

					If(!$resultquery){
						die("Query Error : ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
					}

					while ($data = mysqli_fetch_assoc($resultquery)) {
						?>
						<tr>
							<?php
							echo "<td>$data[bln_thn]</td>";
							echo "<td>$data[d_aktual]</td>";
							?>
							<td>
								<form action="edit.php" method="post">
									<input type="hidden" name="id" value="<?php echo "$data[id]"; ?>">
									<input class="btn btn-primary" type="submit" name="submit" value="Edit">
								</form>
							</td>
							<td>
								<form action="hapus.php" method="post">
									<input type="hidden" name="id" value="<?php echo "$data[id]"; ?>">
									<input type="hidden" name="bln_thn" value="<?php echo "$data[bln_thn]"; ?>">
									<input class="btn btn-danger" type="submit" name="submit" value="Hapus">
								</form>
							</td>
						</tr>
						<?php

					}

					mysqli_free_result($resultquery);
					mysqli_close($koneksi);
					?>
				</table>
			</div>

		</div>
	</div>
	<!-- partial -->
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
</body>
</html>