<?php

// Data penjualan
$data_penjualan = array(52, 59, 71, 92, 103, 120, 142, 162, 182, 199, 220, 239);

// Konstanta smoothing
$alpha = 0.2; // Koefisien smoothing level
$beta = 0.3; // Koefisien smoothing trend
$gamma = 0.4; // Koefisien smoothing musiman
$season_length = 4; // Panjang musiman

// Jumlah periode data penjualan
$n = count($data_penjualan);

// Array untuk menyimpan hasil perhitungan
$level = array();
$trend = array();
$seasonal = array();
$fitted = array();
$forecast = array();

// Inisialisasi level awal
$level[0] = $data_penjualan[0];

// Inisialisasi trend awal
$trend[0] = 0;

// Inisialisasi musiman awal
for ($i = 0; $i < $season_length; $i++) {
    $seasonal[$i] = $data_penjualan[$i];
}

// Perhitungan Holt Winter Exponential Smoothing
for ($i = 1; $i < $n; $i++) {
    $last_level = $level[$i - 1];
    $last_trend = $trend[$i - 1];
    $last_seasonal = $seasonal[$i % $season_length];

    // Perhitungan level, trend, dan musiman
    $level[$i] = $alpha * ($data_penjualan[$i] - $last_seasonal) + (1 - $alpha) * ($last_level + $last_trend);
    $trend[$i] = $beta * ($level[$i] - $last_level) + (1 - $beta) * $last_trend;
    $seasonal[$i % $season_length] = $gamma * ($data_penjualan[$i] - $last_level) + (1 - $gamma) * $last_seasonal;

    // Perhitungan nilai fitted
    $fitted[$i] = $level[$i - 1] + $trend[$i - 1] + $seasonal[$i % $season_length];

    // Perhitungan nilai forecast
    $forecast[$i] = $level[$i - 1] + $trend[$i - 1] + $seasonal[($i + 1) % $season_length];
}

// Menampilkan hasil perhitungan
echo "Data Penjualan: " . implode(", ", $data_penjualan) . "<br><br>";
echo "Level: " . implode(", ", $level) . "<br><br>";
echo "Trend: " . implode(", ", $trend) . "<br><br>";
echo "Musiman: " . implode(", ", $seasonal) . "<br><br>";
echo "Fitted: " . implode(", ", $fitted) . "<br><br>";
echo "Forecast: " . implode(", ", $forecast) . "<br><br>";

?>