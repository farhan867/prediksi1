<!DOCTYPE html>
<html>
<head>
<style>
/* Style untuk sidebar container */
.sidebar-container {
  position: fixed;
  width: 210px;
  height: 100%;
  left: 0;
  background-color: #171717; /* Warna latar belakang sidebar (hitam) */
  padding-top: 20px;
}

.sidebar-logo {
  padding: 10px 15px 10px 30px;
  font-size: 20px;
  background-color: #203b6a; /* Warna latar belakang logo (biru dongker) */
  color: #ffffff; /* Warna teks logo */
}

/* Style untuk sidebar navigation link */
.sidebar-container a {
  padding: 12px 16px;
  text-decoration: none;
  font-size: 16px;
  color: #ffffff;
  display: block;
}

/* Style untuk sidebar navigation link saat di-hover */
.sidebar-container a:hover {
  background-color: #2c507d; /* Warna latar belakang saat di-hover (biru dongker lebih terang) */
}

/* Style untuk sidebar navigation aktif */
.sidebar-container a.active {
  background-color: #004b96; /* Warna latar belakang saat aktif (biru dongker lebih gelap) */
}

/* Style untuk dropdown */
.dropdown-content {
  display: none;
  background-color: #333333;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  margin-left: 30px;
}

.dropdown-content a {
  color: #ffffff;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.sidebar-container a i {
  padding-right: 2px;
}

.sidebar-container a span {
  padding-left: 3px;
}

.sidebar-container .card-img-container {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 20px;
  height: 100px;
}

.sidebar-container .card-img-container img {
  max-width: 100%;
  max-height: 100%;
}
</style>
</head>
<body>
<div class="sidebar-container">
<div class="card-img-container" style="width:170px">
        <img class="card-img-top" src="img/sari_roti.png" alt="Card image">
</div>
<div class="sidebar-logo">
    Aplikasi Prediksi
  </div>
  <a class="active" href="index.php">
    <i class="fa fa-home" aria-hidden="true"></i>
    <span>Home</span>
  </a>

  <a href="data_toko.php">
        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
        <span>Data Toko</span>
      </a>
  
  <a href="data.php">
       <i class="fa fa-shopping-bag" aria-hidden="true"></i>
       <span>Data Penjualan</span>
      </a>
      
  <a href="data_retur.php">
        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
        <span>Data Retur</span>
      </a>

  <div class="dropdown">
    <a href="#forecasting">
      <i class="fa fa-database" aria-hidden="true"></i>
      <span>Prediksi Retur</span>
    </a>
    <div class="dropdown-content">
      <a href="forecast.php">
        <i class="fa fa-database" aria-hidden="true"></i>
        <span>Toko MODI</span>
      </a>
      <a href="peramalan_zaskia.php">
        <i class="fa fa-database" aria-hidden="true"></i>
        <span>Toko ZASKIA</span>
      </a>
      <a href="#method3">
        <i class="fa fa-database" aria-hidden="true"></i>
        <span>Method 3</span>
      </a>
    </div>
  </div>
 
  <a href="data_admin.php">
        <i class="fa fa-users" aria-hidden="true"></i>
        <span>Data Admin</span>
      </a>
  <a href="tentang_kami.php">
        <i class="fa fa-coffee" aria-hidden="true"></i>
        <span>Tentang Kami</span>
      </a>
  <a href="logout.php">
        <i class="fa fa-window-close" aria-hidden="true"></i>
        <span>Keluar</span>
      </a>
</div>
</body>
</html>
