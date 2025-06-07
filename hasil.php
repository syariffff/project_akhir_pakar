<?php 
include 'function.php';
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 0) {
        header("location: indexAdmin.php");
    } 
} 

$gejala = mysqli_query($koneksi, "SELECT * FROM gejala");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
    crossorigin="anonymous"/>
    <link
    href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap"
    rel="stylesheet"/>
    <link rel="stylesheet" href="custom.css" />
    <title>Hasil Diagnosa - Sehat Perutku</title>
</head>
<body>
    <nav class="navbar py-2 navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="img/lambung.jpg" width="60" alt="logo" class="mr-2" />
            <span class="h5 mb-0">Sehat Perutku</span>
            </a>
            <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
            >
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li>
                        <a class="btn px-2 py-2 btn-success ml-2" href="function.php?act=ulang" role="button">Cek Ulang</a>
                    </li>
                    <li>
                        <a class="btn px-2 py-2 btn-primary ml-2" href="logout.php" role="button">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hasil mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="mb-0">Hasil Diagnosa Berdasarkan Certainty Factor</h3>
                        </div>
                        <div class="card-body">
                            <?php if(isset($_SESSION['maag'])) { ?>
                            
                            <h5 class="mb-4">Tingkat Kepercayaan Penyakit:</h5>
                            
                            <?php
                            $hasil = [
                                'Maag' => $_SESSION['maag'],
                                'GERD' => $_SESSION['gerd'],
                                'Irritable Bowel Syndrome' => $_SESSION['iritableBowel'],
                                'Dispepsia' => $_SESSION['dispepsia'],
                                'Radang Usus' => $_SESSION['radangUsus'],
                                'Infeksi Saluran Cerna' => $_SESSION['infeksiSaluranCerna'],
                            ];
                            
                            // Urutkan dari yang tertinggi
                            arsort($hasil);
                            
                            foreach ($hasil as $penyakit => $nilai_cf) {
                                $persentase = $nilai_cf;
                                $warna_progress = '';
                                
                                if ($persentase >= 70) {
                                    $warna_progress = 'bg-danger';
                                } elseif ($persentase >= 50) {
                                    $warna_progress = 'bg-warning';
                                } elseif ($persentase >= 30) {
                                    $warna_progress = 'bg-info';
                                } else {
                                    $warna_progress = 'bg-success';
                                }
                            ?>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <strong><?= $penyakit ?></strong>
                                    <span class="font-weight-bold"><?= $persentase ?>%</span>
                                </div>
                                <div class="progress" style="height: 25px;">
                                    <div class="progress-bar <?= $warna_progress ?>" role="progressbar" 
                                         style="width: <?= $persentase ?>%" 
                                         aria-valuenow="<?= $persentase ?>" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                        <?= $persentase ?>%
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            
                            <?php
                            // Temukan penyakit dengan CF tertinggi
                            $hasil_id = [
                                1 => $_SESSION['maag'],
                                2 => $_SESSION['gerd'],
                                3 => $_SESSION['iritableBowel'],
                                4 => $_SESSION['dispepsia'],
                                5 => $_SESSION['radangUsus'],
                                6 => $_SESSION['infeksiSaluranCerna'],
                            ];

                            $max_cf = max($hasil_id);
                            $id_tertinggi = [];
                            
                            foreach ($hasil_id as $id_penyakit => $cf) {
                                if ($cf == $max_cf && $cf > 0) {
                                    $id_tertinggi[] = $id_penyakit;
                                }
                            }

                            if (count($id_tertinggi) > 0 && $max_cf > 0) {
                                echo "<div class='alert alert-info mt-4'>";
                                echo "<h4 class='alert-heading'>Rekomendasi Berdasarkan Diagnosa</h4>";
                                echo "<p><strong>Tingkat kepercayaan tertinggi: " . $max_cf . "%</strong></p>";
                                
                                if ($max_cf >= 70) {
                                    echo "<div class='alert alert-danger'>";
                                    echo "<strong>Tingkat Kepercayaan Tinggi (≥70%)</strong><br>";
                                    echo "Sangat disarankan untuk segera berkonsultasi dengan dokter untuk pemeriksaan lebih lanjut.";
                                    echo "</div>";
                                } elseif ($max_cf >= 50) {
                                    echo "<div class='alert alert-warning'>";
                                    echo "<strong>Tingkat Kepercayaan Sedang (50-69%)</strong><br>";
                                    echo "Disarankan untuk memperhatikan gejala dan berkonsultasi dengan dokter jika gejala berlanjut.";
                                    echo "</div>";
                                } else {
                                    echo "<div class='alert alert-info'>";
                                    echo "<strong>Tingkat Kepercayaan Rendah (<50%)</strong><br>";
                                    echo "Lakukan observasi terhadap gejala dan terapkan pola hidup sehat.";
                                    echo "</div>";
                                }
                                
                                echo "<h5 class='mt-3'>Solusi dan Saran:</h5>";
                                foreach ($id_tertinggi as $id) {
                                    $query = "SELECT * FROM solusi WHERE id_penyakit = '$id'";
                                    $data = mysqli_query($koneksi, $query);
                                    while ($row = mysqli_fetch_array($data)) {
                                        echo "<div class='card mt-2'>";
                                        echo "<div class='card-body'>";
                                        echo "<p><strong>Solusi:</strong> " . $row['solusi'] . "</p>";
                                        echo "</div>";
                                        echo "</div>";
                                    }
                                }
                                echo "</div>";
                            } else {
                                echo "<div class='alert alert-warning mt-4'>";
                                echo "<h4 class='alert-heading'>Tidak Ada Indikasi Penyakit</h4>";
                                echo "<p>Berdasarkan gejala yang Anda pilih, tidak ditemukan indikasi penyakit pencernaan yang signifikan.</p>";
                                echo "<p>Namun, jika Anda tetap merasa tidak nyaman, disarankan untuk berkonsultasi dengan dokter.</p>";
                                echo "</div>";
                            }
                            ?>
                            
                            <?php } else { ?>
                            <div class="alert alert-warning">
                                <p>Data diagnosa tidak ditemukan. Silakan lakukan diagnosa terlebih dahulu.</p>
                                <a href="index.php" class="btn btn-primary">Kembali ke Diagnosa</a>
                            </div>
                            <?php } ?>
                            
                        </div>
                    </div>
                    
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title">Informasi Penting</h5>
                            <p class="card-text">
                                <strong>Disclaimer:</strong> Hasil diagnosa ini hanya sebagai referensi awal dan tidak menggantikan 
                                konsultasi medis dengan dokter profesional. Untuk diagnosis yang akurat dan penanganan yang tepat, 
                                selalu konsultasikan kondisi Anda dengan dokter atau tenaga medis yang kompeten.
                            </p>
                            <p class="text-muted">
                                <small>
                                    Sistem ini menggunakan metode Certainty Factor (CF) untuk menghitung tingkat kepercayaan 
                                    berdasarkan gejala yang Anda pilih dan basis pengetahuan medis.
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <img width="100%" src="img/tes.png" alt="tes" class="img-fluid mb-4" />
                    
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tingkat Kepercayaan</h5>
                            <div class="mb-2">
                                <span class="badge badge-success">0-29%</span> Rendah
                            </div>
                            <div class="mb-2">
                                <span class="badge badge-info">30-49%</span> Cukup
                            </div>
                            <div class="mb-2">
                                <span class="badge badge-warning">50-69%</span> Sedang
                            </div>
                            <div class="mb-2">
                                <span class="badge badge-danger">70-100%</span> Tinggi
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<script
    src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"
></script>
<script
    src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"
></script>
<script
    src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"
></script>
<script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"
></script>
</html>