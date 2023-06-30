<?php
session_start();

if (!isset($_SESSION["username"])) {
	header("Location: login.php");
}

include_once("koneksi.php");

$querytampil = "SELECT tb_retur1.kode_retur, tb_retur1.nama_toko, tb_produk.nama_produk, tb_retur1.bln_thn, tb_retur1.jumlah_retur FROM tb_retur1
INNER JOIN tb_produk ON tb_retur1.kode_produk = tb_produk.kode_produk";

// Mengambil nilai pencarian nama toko
if (isset($_GET['search_nama_toko']) && $_GET['search_nama_toko'] != '') {
	$search_nama_toko = $_GET['search_nama_toko'];
	$querytampil .= " WHERE tb_retur1.nama_toko LIKE '%$search_nama_toko%'";
}

// Mengambil nilai pencarian nama produk
if (isset($_GET['search_nama_produk']) && $_GET['search_nama_produk'] != '') {
	$search_nama_produk = $_GET['search_nama_produk'];
	$querytampil .= isset($_GET['search_nama_toko']) && $_GET['search_nama_toko'] != '' ? " AND" : " WHERE";
	$querytampil .= " tb_produk.nama_produk LIKE '%$search_nama_produk%'";
}

if (isset($_GET['pesan_sukses'])) {
	$pesan_sukses = $_GET['pesan_sukses'];
}

// Variabel untuk pagination
$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$querytampil .= " LIMIT $start, $limit";

?>

<!DOCTYPE html>
<html lang="en">
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
	<?php
	include_once 'sidebar.php';
	?>

	<div class="content-container">
		<div class="container-fluid">
			<div class="jumbotron">
				<h2 style="margin-bottom: 25px;">Data Retur</h2>
				<?php
				if (isset($pesan_sukses)) {
					echo "<div class='alert alert-success alert-dismissible'>
					<a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					<strong>Berhasil!</strong> " . $pesan_sukses . "</div>";
				}
				?>
				<div class="container">
					<div style="margin-bottom: 10px;">
						<a class="btn btn-primary" href="tambah.php">Tambah Data</a>
					</div>
					<div style="margin-bottom: 10px;">
						<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<input type="text" name="search_nama_toko" placeholder="Cari Nama Toko" value="<?php echo isset($_GET['search_nama_toko']) ? $_GET['search_nama_toko'] : ''; ?>">
							<input type="text" name="search_nama_produk" placeholder="Cari Nama Produk" value="<?php echo isset($_GET['search_nama_produk']) ? $_GET['search_nama_produk'] : ''; ?>">
							<button type="submit" class="btn btn-primary">Cari</button>
						</form>
					</div>
					<table class="table table-hover table-bordered">
						<tr>
							<th>Kode Retur</th>
							<th>Nama Toko</th>
							<th>Nama Produk</th>
							<th>Bulan - Tahun</th>
							<th>Data Aktual</th>
							<th colspan="2">Action</th>
						</tr>
						<?php
						$resultquery = mysqli_query($koneksi, $querytampil);

						if (!$resultquery) {
							die("Query Error : " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
						}

						while ($data = mysqli_fetch_assoc($resultquery)) {
							?>
							<tr>
								<?php
								echo "<td>$data[kode_retur]</td>";
								echo "<td>$data[nama_toko]</td>";
								echo "<td>$data[nama_produk]</td>";
								echo "<td>$data[bln_thn]</td>";
								echo "<td>$data[jumlah_retur]</td>";
								?>
								<td>
									<form action="edit.php" method="post">
										<input type="hidden" name="kode_retur" value="<?php echo "$data[kode_retur]"; ?>">
										<input class="btn btn-primary" type="submit" name="submit" value="Edit">
									</form>
								</td>
								<td>
									<form action="hapus.php" method="post">
										<input type="hidden" name="kode_retur" value="<?php echo "$data[kode_retur]"; ?>">
										<input type="hidden" name="bln_thn" value="<?php echo "$data[bln_thn]"; ?>">
										<input class="btn btn-danger" type="submit" name="submit" value="Hapus">
									</form>
								</td>
							</tr>
						<?php
						}

						mysqli_free_result($resultquery);

						// Menghitung total data untuk pagination
						$querytotal = "SELECT COUNT(*) as total FROM tb_retur1";
						$resulttotal = mysqli_query($koneksi, $querytotal);
						$rowtotal = mysqli_fetch_assoc($resulttotal);
						$total_pages = ceil($rowtotal['total'] / $limit);

						mysqli_close($koneksi);
						?>
					</table>

					<!-- Pagination -->
					<div class="pagination">
						<?php
						$pagelink = "";

						if ($page > 1) {
							$pagelink .= "<a href='data_retur.php?page=1'>First</a>";
							$prevpage = $page - 1;
							$pagelink .= "<a href='data_retur.php?page=$prevpage'>Prev</a>";
						}

						for ($i = max(1, $page - 3); $i <= min($page + 3, $total_pages); $i++) {
							if ($i == $page) {
								$pagelink .= "<a class='active' href='data_retur.php?page=$i'>$i</a>";
							} else {
								$pagelink .= "<a href='data_retur.php?page=$i'>$i</a>";
							}
						}

						if ($page < $total_pages) {
							$nextpage = $page + 1;
							$pagelink .= "<a href='data_retur.php?page=$nextpage'>Next</a>";
							$pagelink .= "<a href='data_retur.php?page=$total_pages'>Last</a>";
						}

						echo $pagelink;
						?>
					</div>
					<!-- End Pagination -->
				</div>
			</div>
		</div>
	</div>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
</body>
<style>
.pagination {
    margin-top: 20px;
}

.pagination a {
    color: #007bff;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color 0.3s;
    border: 1px solid #ddd;
    margin-right: 5px;
}

.pagination a.active {
    background-color: #007bff;
    color: white;
}

.pagination a:hover:not(.active) {
    background-color: #ddd;
}
</style>

</html>
