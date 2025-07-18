<?php
// Ambil data XML dari BMKG
$data = simplexml_load_file("https://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.xml") or die("Gagal mengambil data!");

// Fungsi untuk cek apakah lokasi mengandung kata "ACEH"
function isGempaDiAceh($lokasi) {
  return stripos($lokasi, 'ACEH') !== false;
}

// Judul
echo "<h2>Daftar Gempabumi di Wilayah ACEH</h2>";

$i = 1;
foreach ($data->gempa as $gempa) {
  if (isGempaDiAceh($gempa->Wilayah)) {
    echo "No: " . $i++ . "<br>";
    echo "Tanggal: " . $gempa->Tanggal . "<br>";
    echo "Jam: " . $gempa->Jam . "<br>";
    echo "DateTime: " . $gempa->DateTime . "<br>";
    echo "Magnitudo: " . $gempa->Magnitude . "<br>";
    echo "Kedalaman: " . $gempa->Kedalaman . "<br>";
    echo "Koordinat: " . $gempa->point->coordinates . "<br>";
    echo "Lintang: " . $gempa->Lintang . "<br>";
    echo "Bujur: " . $gempa->Bujur . "<br>";
    echo "Wilayah: " . $gempa->Wilayah . "<br>";
    echo "Potensi: " . $gempa->Potensi . "<br><br>";
  }
}

if ($i === 1) {
  echo "Tidak ditemukan gempa di wilayah Aceh dalam data terbaru.";
}
?>
